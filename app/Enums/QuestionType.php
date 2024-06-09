<?php

namespace App\Enums;

enum QuestionType: string
{
    const TRUE_FALSE = 'true_false';
    const CHOICES = 'choices';

    const TEXT = 'text';

    public static function toSelectOptions(): array
    {
        return [
            self::TEXT => 'Text',
            self::TRUE_FALSE => 'True/False',
            self::CHOICES => 'Choices',
        ];
    }

    public static function toValidationRequest(): array
    {
        return [
            self::TEXT,
            self::TRUE_FALSE,
            self::CHOICES,
        ];
    }
}
