<?php

namespace App\Trait;


use App\Models\Tenant;
use App\Scope\TenantScope;
use Filament\Facades\Filament;

/**
 * @property-read Tenant $tenant
 */
trait BelongsToTenant
{
    public function getTenantIdColumn(): string
    {
        return 'tenant_id';
    }

    public function tenant()
    {
        return $this->belongsTo(config('tenancy.tenant_model'), $this->getTenantIdColumn());
    }

    public static function bootBelongsToTenant()
    {
        static::addGlobalScope(new TenantScope());

        static::creating(function ($model) {
            if (! $model->getAttribute($model->getTenantIdColumn()) && ! $model->relationLoaded('tenant')) {
                if ($tenant = Filament::getTenant() ?? tenant()) {
                    $model->setAttribute($model->getTenantIdColumn(), $tenant->getTenantKey());
                    $model->setRelation('tenant', $tenant);
                }
            }
        });
    }
}
