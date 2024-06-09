<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\CompletedExportNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class SendCompletedExportNotification implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public User $user,public string $fileName)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(): void
    {
        $this->user->notify(new CompletedExportNotification($this->fileName));
    }
}
