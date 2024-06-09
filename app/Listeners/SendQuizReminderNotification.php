<?php

namespace App\Listeners;

use App\Events\SubscribedProcessed;
use App\Models\Member;
use App\Models\Quiz;
use App\Notifications\RemindQuizNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendQuizReminderNotification
{
    /**
     * Create the event listener.
     */
    public function __construct(public Member $member, public Quiz $quiz, public string $token)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(): void
    {
        $event->member->notify((new RemindQuizNotification($event->quiz, $event->token)));
    }
}
