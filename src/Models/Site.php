<?php

namespace BertBijnens\LaravelAnalytics\Models;

class Site extends BaseModel
{
    public function log_files() {
        return $this->hasMany(LogFile::class);
    }

    public function request_logs() {
        return $this->hasMany(RequestLog::class);
    }

    public static function getByLogsDir($dirname) {
        $site = Site::where('logs_dir', $dirname)->first();

        if(!$site) {
            $site = new Site();

            $site->logs_dir = $dirname;
            $site->name = substr($dirname, 0, strrpos($dirname, '/'));
            $site->name = substr($site->name, strrpos($site->name, '/') + 1);

            $site->save();
        }

        return $site;
    }

    public function list_logs() {

        $logs = scandir($this->logs_dir);
        $logs = array_values(array_filter($logs, function($logFile) {
            return strlen($logFile) > 0 && $logFile[0] != '.';
        }));
        natcasesort($logs);

        //TODO keep track of start time
        foreach($logs as $k=>$log) {
            
            $filemtime = date('Y-m-d H:i:s', filemtime($this->logs_dir . DIRECTORY_SEPARATOR . $log));
            if($filemtime > $this->synced_at) {
                //TODO process file
                $hash = md5_file($this->logs_dir . DIRECTORY_SEPARATOR . $log);

                if($log == 'access.log' || $log == 'error.log') {
                    $logFile = $this->log_files()->where('filename', $log)->first();
                }
                else {
                    $logFile = $this->log_files()->where('hash', $hash)->first();
                }

                if(!$logFile) {
                    $logFile = new LogFile();

                    $logFile->site_id = $this->id;

                    if(strpos($log, 'access') !== false) {
                        $logFile->type = 'access';
                    }
                    else if(strpos($log, 'error') !== false) {
                        $logFile->type = 'error';
                    }
                }

                $logFile->filename = $log;
                $logFile->location = $this->logs_dir . DIRECTORY_SEPARATOR . $log;

                $logFile->hash = $hash;
                $logFile->size = filesize($logFile->location);

                $logFile->modified_at = $filemtime;

                if($logFile->size != 0 && $logFile->isDirty()) {
                    $logFile->save();
                }
            }
            //
            $logs[$k] = $logFile;
        }

        return $logs;
    }

    public static function detect() {
        $site_dir = base_path() . '/../../';

        $sites = scandir($site_dir);
        $sites = array_values(array_filter($sites, function($logFile) {
            return strlen($logFile) > 0 && $logFile[0] != '.';
        }));
        natcasesort($sites);

        $cache = array();
        foreach($sites as $site) {
            $site = realpath($site_dir . $site) . DIRECTORY_SEPARATOR . 'logs';

            if(file_exists($site)) {

                $temp = Site::getByLogsDir($site);
                $cache[] = $temp;

            }
            else {
                unset($site);
            }
        }

        return $cache;
    }
}
