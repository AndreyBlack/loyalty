<?php

namespace App\Http\Middleware;

use App\Services\Sms\NotificationService;
use App\Services\Sms\SmsNotifiable;
use Illuminate\Http\Request;
use Closure;

class AddSentCodeField
{
    public function handle(Request $request, Closure $next)
    {

        if ($request->filled('phone')) {
            $key = NotificationService::keyGenerate(new SmsNotifiable(session()->getId(), $request->get('phone')));
            $code = RedisManager::connection('db')->get($key);
            if (!is_null($code)) {
                $request = $request->merge(['sentCode' => $code]);
            }
        }

        return $next($request);
    }
}