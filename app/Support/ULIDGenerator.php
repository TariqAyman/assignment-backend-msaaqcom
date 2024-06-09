<?php

namespace App\Support;

use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Stancl\Tenancy\Contracts\UniqueIdentifierGenerator;

class ULIDGenerator implements UniqueIdentifierGenerator
{
    /**
     * Generate a new ULID for the model.
     *
     * @param $resource
     * @return string
     */
    public static function generate($resource): string
    {
        return strtolower((string) Str::ulid());
    }
}
