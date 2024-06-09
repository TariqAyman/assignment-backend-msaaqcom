<?php

namespace App\Http\Controllers\API\V1\Tenant\Auth;

use App\Http\Controllers\API\AbstractApiController;
use App\Http\Requests\V1\Tenant\Auth\RegisterRequest;
use App\Models\Tenant;
use App\Models\User;
use Filament\Events\Auth\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedById;

class RegisterController extends AbstractApiController
{
    /**
     * Handle an register attempt.
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     * @throws TenantCouldNotBeIdentifiedById
     */
    public function __invoke(RegisterRequest $request)
    {
        $tenant = $this->createTenant($request->all());

        $user = User::query()->create($request->all());

        $tenant->users()->attach($user->id);

        event(new Registered($user));

        $response = [
            'user' => $user->toArray(),
            'token' => $user->createToken('login-api')->plainTextToken,
            'type' => 'bearer',
            'tenant_id' => $user->tenants->first()->id,
        ];

        return $this->success($response);
    }

    protected function createTenant($data)
    {
        $tenant = Tenant::query()
            ->create([
                'name' => $data['tenant_name'],
            ]);

        $tenant->update([
            'domain' => $tenant->id . '.' . config('tenancy.tenant_subdomain_domain'),
        ]);

        return $tenant;
    }
}
