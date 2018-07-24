<?php

namespace BertBijnens\LaravelAnalytics\Models;

use Illuminate\Http\Response;

class ResponseBag {

    public $request;

    public $headers;
    public $content;
    public $status;

    public static function fromResponse(Response $response, RequestBag $requestBag) {

        $responseBag = new ResponseBag();

        $responseBag->setRequest($requestBag);

        $responseBag->setHeaders($response->headers->all());
        $responseBag->setContent($response->getContent());
        $responseBag->setStatus($response->getStatusCode());

        return $responseBag;
    }

    public function setRequest(RequestBag $request) {
        $this->request = $request->id;
    }

    public function setHeaders(array $serverData) {
        $this->headers = $serverData;
    }
    public function setContent($content) {
        $this->content = $content; substr($content, 0, 5000);
    }
    public function setStatus($serverData) {
        $this->status = $serverData;
    }
}