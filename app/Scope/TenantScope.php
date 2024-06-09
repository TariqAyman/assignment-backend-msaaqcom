<?php

namespace App\Scope;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Trait\BelongsToTenant;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (!(Filament::getTenant() || tenant())) {
            return;
        }

        $builder->where($model->qualifyColumn($model->getTenantIdColumn()), (Filament::getTenant() ?? tenant())->getTenantKey());
    }

    public function extend(Builder $builder)
    {
        $builder->macro('withoutTenancy', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });
    }
}
