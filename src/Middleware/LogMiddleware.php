<?php

namespace BertBijnens\LaravelAnalytics\Middleware;

use BertBijnens\LaravelAnalytics\Managers\LogManager;
use Closure;

class LogMiddleware
{
    protected static $logManager;

    public function __construct() {
        if(!self::$logManager) {
            self::$logManager = new LogManager();
        }
    }

    public function handle($request, Closure $next) {

        if($this->shouldLog($request)) {
            self::$logManager->request($request);
        }

        return $next($request);
    }

    public function terminate($request, $response) {
        if($this->shouldLog($request)) {
            self::$logManager->response($response);
        }
    }

    public function shouldLog($request) {
        return substr($request->path(), 0, 9) != 'analytics';
    }
}
