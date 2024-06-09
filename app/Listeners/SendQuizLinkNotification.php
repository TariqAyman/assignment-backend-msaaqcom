<?php

namespace App\Listeners;

use App\Events\SubscribedProcessed;
use App\Notifications\LinkQuizNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendQuizLinkNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SubscribedProcessed $event): void
    {
        $event->member->notify(new LinkQuizNotification($event->quiz, $event->token));

    }
}
