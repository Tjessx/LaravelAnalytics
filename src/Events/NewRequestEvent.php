<?php

namespace BertBijnens\LaravelAnalytics\Events;

use BertBijnens\LaravelAnalytics\Models\RequestBag;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewRequestEvent implements ShouldBroadcast
{

    public $requestBag;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(object $requestBag)
    {
        $this->requestBag = $requestBag;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['analytics.requests'];
    }

    public function broadcastAs()
    {
        return 'requests.new';
    }

    public function broadcastWith() {
        return [
            $this->requestBag
        ];
    }
}
