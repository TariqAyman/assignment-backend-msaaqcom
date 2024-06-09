<?php

namespace App\Enums;

enum QuizType: string
{
    const IN_TIME = 'in-time';
    const OUT_OF_TIME = 'out-of-time';

    public static function toSelectOptions(): array
    {
        return [
            self::IN_TIME => 'In Time',
            self::OUT_OF_TIME => 'Out of Time',
        ];
    }

    public static function toValidationRequest(): array
    {
        return [
            self::IN_TIME,
            self::OUT_OF_TIME,
        ];
    }
}
