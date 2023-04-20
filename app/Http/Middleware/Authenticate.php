<?php

namespace App\Http\Middleware;

use App\Common\ErrorCode;
use App\Exceptions\ApiException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()){
            throw new ApiException(ErrorCode::UNAUTHORIZED);
        }
        return null;
//        return $request->expectsJson() ? null : route('login');
    }
}
