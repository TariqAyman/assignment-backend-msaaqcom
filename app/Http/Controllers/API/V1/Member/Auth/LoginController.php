<?php

namespace App\Http\Controllers\API\V1\Member\Auth;

use App\Http\Controllers\API\AbstractApiController;
use App\Http\Requests\V1\Member\Auth\LoginRequest;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Stancl\Tenancy\Exceptions\TenantCouldNotBeIdentifiedById;

class LoginController extends AbstractApiController
{
    /**
     * Handle an authentication attempt.
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     * @throws TenantCouldNotBeIdentifiedById
     */
    public function authenticate(LoginRequest $request)
    {
        $user = Member::query()
            ->where('email', $request->validated('email'))
            ->first();

        if ($this->determineIfUserCanLogin($user, $request)) {
            throw ValidationException::withMessages([
                'failed' => __('auth.failed'),
            ]);
        }

        $response = [
            'user' => $user->toArray(),
            'token' => $user->createToken('login-api')->plainTextToken,
            'type' => 'bearer',
            'tenant_id' => $user->tenant_id,
        ];

        return $this->success($response);
    }

    public function determineIfUserCanLogin($user, LoginRequest $request)
    {
        return !$user
            || is_null($user->password)
            || !Hash::check($request->validated('password'), $user->password);
    }

    /**
     * Handle logout attempt.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success([], statusCode: Response::HTTP_NO_CONTENT);
    }
}
