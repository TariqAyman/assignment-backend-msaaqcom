<?php

namespace App\Http\Controllers\API\V1\Member\Auth;

use App\Http\Controllers\API\AbstractApiController;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class ListTenantsController extends AbstractApiController
{
    public function __invoke()
    {
        return $this->success(['tenants' => Tenant::all()]);
    }
}
