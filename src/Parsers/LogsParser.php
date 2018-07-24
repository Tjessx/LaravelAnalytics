<?php

namespace BertBijnens\LaravelAnalytics\Parsers;

use BertBijnens\LaravelAnalytics\Models\LogFile;
use BertBijnens\LaravelAnalytics\Models\RequestLog;

/**
 * Created by PhpStorm.
 * User: bertbijnens
 * Date: 11/12/17
 * Time: 20:00
 */

class LogsParser
{

    public $command = null;

    public function __construct($command) {
        $this->command = $command;
    }

    public function info($data) {
        if($this->command != null) {
            return $this->command->info($data);
        }
    }

    public function dumbFilter($line) {

        static $links = [
            '[' => ']',
            '"' => '"',
        ];
        static $trimable = '[]"';

        $cache = array();

        $isStart = null;
        $startPoint = 0;

        $line = ' ' . trim($line) . ' ';

        for($i = 1; $i < strlen($line); $i++) {

            if($isStart == null) {

                foreach($links as $k=>$v) {
                    if($k == $line[$i]) {
                        $isStart = $k;

                        continue;
                    }
                }

                if($line[$i] == ' ') {

                    $cache[] = trim(substr($line, $startPoint + 1, $i - $startPoint - 1), $trimable);

                    $startPoint = $i;
                }
            }
            else {
                foreach($links as $k=>$v) {
                    if($k == $isStart && $v == $line[$i]) {
                        $isStart = null;

                        continue;
                    }
                }
            }
        }

        return $cache;
    }

    public function getDataFromLine($line) {
        return $this->dumbFilter($line);
    }

    public function handleLines($filename, $callback) {

        if(strpos($filename,'.gz') !== false) {
            $lines = gzfile($filename);
            foreach ($lines as $line) {
                $callback($line);
            }

            return;
        }

        $handle = fopen($filename, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                // process the line read.
                $callback($line);
            }

            fclose($handle);
        }
    }

    public function handleFile($logFile, $excludingUntil) {

        $counter = 0;

        $this->handleLines($logFile->location, function($line) use(&$counter, $logFile, $excludingUntil) {

            $data = $this->getDataFromLine($line);
            $temp = (RequestLog::FromData($data));

            if($temp && $temp->request_date >= $logFile->synced_at && $temp->request_date < $excludingUntil) {
                $temp->log_file_id = $logFile->id;
                $temp->site_id = $logFile->site_id;
                $temp->save();
                $counter++;
            }
        });

        return $counter;
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(LogFile $logFile)
    {
        if($logFile->synced_at == null || $logFile->modified_at > $logFile->synced_at) {
            $logFileSyncStart = date('Y-m-d H:i:s');

            $logFile->log_count += $this->handleFile($logFile, $logFileSyncStart);
            $logFile->synced_at = $logFileSyncStart;
            $logFile->save();
        }

        return $logFile->log_count;
    }
}
