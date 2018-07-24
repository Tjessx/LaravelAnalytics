<?php

namespace BertBijnens\LaravelAnalytics\Models;

class RequestLog extends BaseModel {

    public static $page_cache = array();

    protected $fillable = [
        'ip',
        'none',
        'none2',
        'request_date', //TODO parse
        'response_code',
        'response_bytes',
        'response_time',
        'request_referer', //TODO waar dit opslaan?
    ];

    //request_user_agent_id

    //request_type
    //request_url
    //request_protocol

    public function setRequestRefererAttribute($value) {
        $this->request_referer = self::formatString($value);
    }

    public static function mapDefault($data) {
        //TODO lets pretend this is enough
        if(count($data) == 9) {
            return array_combine([
                'ip',
                'none',
                'none2',
                'request_date',
                'request',
                'response_code',
                'response_bytes',
                'request_referer',
                'request_user_agent',
            ], $data);
        }
        else if(count($data) == 10) {
            return array_combine([
                'ip',
                'none',
                'none2',
                'request_date',
                'request',
                'response_code',
                'response_bytes',
                'response_time',
                'request_referer',
                'request_user_agent',
            ], $data);
        }
        else if(count($data) == 11) {
            return array_combine([
                'ip',
                'none',
                'none2',
                'request_date',
                'request',
                'response_code',
                'response_bytes',
                'response_time',
                'request_referer',
                'request_user_agent',
                'none3'
            ], $data);
        }

        return false;
    }

    public static function formatUrl($url) {
        if(strpos($url, '?') !== false) {
            $url = substr($url, 0, strpos($url, '?'));
        }

        if(strlen($url) <= 75) {
            if(!isset(self::$page_cache[$url])) {
                self::$page_cache[$url] = 0;
            }

            self::$page_cache[$url]++;
        }


        return $url;
    }

    public static function formatString($string, $maxLength = 191, $endOnDots = true) {
        if(strlen($string) > $maxLength) {

            if($endOnDots) {
                return substr($string, 0, $maxLength - 3) . '...';
            }

            return substr($string, 0, $maxLength);
        }

        return $string;
    }

    public static function FromData($data) {

        $data = self::mapDefault($data);

        if(!is_array($data)) {
            return null;
        }

        $temp = new self($data);

        if(isset($data['request'])) {
            $t = explode(' ', ($data['request']));

            $temp->request_type = in_array($t[0] ?? '', ['GET','POST','DELETE','PUT','OPTIONS','PATCH','CONNECT','HEAD','TRACE','OTHER']) ? $t[0] : 'OTHER';
            $temp->request_url_complete = $t[1] ?? null;
            $temp->request_protocol = $t[2] ?? null;
        }

        $temp->user_agent_id = UserAgent::getByName($data['request_user_agent'])->id;
        $temp->request_date = date('Y-m-d H:i:s', strtotime($data['request_date']));

        if($temp->request_url_complete != null) {
            $url = $temp->request_url_complete;

            if(strrpos($url, '/') !== false) {
                $t = substr($url,strrpos($url, '/'));
                if(strpos($t, '.') !== false) {
                    $temp->is_file = true;
                }
            }

            $temp->request_url = self::formatUrl($url);

            if(strpos($temp->request_url, '/api/') === 0) {
                $temp->is_api = true;
            }
        }

        if($temp->ip != null && strlen($temp->ip) > 0) {
            if(strpos($temp->ip, ':') !== false) {
                $temp->ip_version = 'ipv6';
            }
            else {
                $temp->ip_version = 'ipv4';
            }
        }

        return $temp;
    }
}