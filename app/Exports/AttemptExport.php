<?php

namespace App\Exports;

use App\Models\Attempt;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class AttemptExport implements FromQuery, ShouldQueue
{
    use Exportable;

    public function __construct(public array $filter)
    {
    }

    public function query()
    {
        return Attempt::with(['member', 'quiz'])
            ->when($this->filter['member_id'], function ($query, $memberId) {
                $query->where('member_id', $memberId);
            })
            ->when($this->filter['quiz_id'], function ($query, $quizId) {
                $query->where('quiz_id', $quizId);
            });
    }
}
