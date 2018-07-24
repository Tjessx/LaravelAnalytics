<?php

namespace BertBijnens\LaravelAnalytics\Managers;

use BertBijnens\LaravelAnalytics\Events\NewRequestEvent;
use BertBijnens\LaravelAnalytics\Events\NewResponseEvent;
use BertBijnens\LaravelAnalytics\Models\RequestBag;
use BertBijnens\LaravelAnalytics\Models\ResponseBag;
use BertBijnens\LaravelAnalytics\Providers\PusherProvider;
use Illuminate\Http\Request;

class LogManager {

    protected $_request;
    protected $_response;

    public function request(Request $request) {
        $this->_request = RequestBag::fromRequest($request);

        (new PusherProvider())->broadcast(function() {
            event(new NewRequestEvent($this->_request));
        });
    }

    public function response($response) {
        $this->_response = ResponseBag::fromResponse($response, $this->_request);

        (new PusherProvider())->broadcast(function() {
            event(new NewResponseEvent($this->_response));
        });
    }

    public function __destruct() {

        /*$request = $this->_request;


        file_put_contents('request.txt', json_encode($this->_request));
        file_put_contents('response.txt', json_encode($this->_response));*/
    }
}