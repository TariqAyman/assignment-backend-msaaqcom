<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SlugHelper
{
    public static function generateUniqueSlug(Model|string $model, $title, $modelId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (static::slugExists($model, $slug, $modelId)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    protected static function slugExists(Model|string $model, $slug, $modelId): bool
    {
        return $model::query()->where('slug', $slug)
            ->when($modelId, function ($query, $modelId) {
                return $query->where('id', '!=', $modelId);
            })
            ->exists();
    }
}
