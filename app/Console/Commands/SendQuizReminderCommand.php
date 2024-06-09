<?php

namespace App\Console\Commands;

use App\Listeners\SendQuizReminderNotification;
use App\Notifications\RemindQuizNotification;
use App\Repositories\QuizRepository;
use Illuminate\Console\Command;

class SendQuizReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-quiz-reminder-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(QuizRepository $quizRepository)
    {
        $quizRepository
            ->where('start_date', now()->subHour())
            ->each(function ($quiz) {
                $quiz->members->each(function ($member) use ($quiz) {
                    $member->notify(new RemindQuizNotification($quiz, $member->pivot->token));
                });
            });
    }
}
