<?php

namespace BertBijnens\LaravelAnalytics\Models;

use Illuminate\Http\Request;

class RequestBag {

    public $id;

    public $server;
    public $headers;
    public $cookies;
    public $request;
    public $files;

    public static function fromRequest(Request $request) {

        $requestBag = new RequestBag();

        $requestBag->setServer($request->server->all());
        $requestBag->setHeaders($request->headers->all());
        $requestBag->setCookies($request->cookies->all());
        $requestBag->setRequest($request->request->all());
        $requestBag->setFiles($request->files->all());

        $requestBag->generateId();

        return $requestBag;
    }

    public function setServer(array $serverData) {
        $this->server = $serverData;
    }
    public function setHeaders(array $serverData) {
        $this->headers = $serverData;
    }
    public function setCookies(array $serverData) {
        $this->cookies = $serverData;
    }
    public function setRequest(array $serverData) {
        $this->request = $serverData;
    }
    public function setFiles(array $serverData) {
        $this->files = $serverData;
    }

    public function generateId() {
        $this->id = md5(json_encode($this));
    }
}