<?php

namespace App\Http\Controllers\API\V1\Member\Auth;

use App\Http\Controllers\API\AbstractApiController;
use App\Http\Requests\V1\Member\Auth\RegisterRequest;
use App\Models\Member;
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
        $user = Member::query()->create($request->all());

        $response = [
            'user' => $user->toArray(),
            'token' => $user->createToken('login-api')->plainTextToken,
            'type' => 'bearer',
            'tenant_id' => $user->tenant_id,
        ];

        return $this->success($response);
    }
}
