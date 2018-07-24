<?php

namespace BertBijnens\LaravelAnalytics\Events;

use BertBijnens\LaravelAnalytics\Models\RequestBag;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewResponseEvent implements ShouldBroadcast
{

    public $responseBag;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(object $responseBag)
    {
        $this->responseBag = $responseBag;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['analytics.responses'];
    }

    public function broadcastAs()
    {
        return 'responses.new';
    }

    public function broadcastWith() {
        return [
            $this->responseBag
        ];
    }
}
