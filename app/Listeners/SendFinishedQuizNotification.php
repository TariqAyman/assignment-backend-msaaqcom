<?php

namespace App\Listeners;

use App\Events\FinishedProcessed;
use App\Notifications\FinishedQuizNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendFinishedQuizNotification
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
    public function handle(FinishedProcessed $event): void
    {
        $event->member->notify(new FinishedQuizNotification($event->member, $event->attempt));
    }
}
