<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        // التحقق هنا من دور المستخدم ومنع غير المسؤولين من الوصول
        if ($request->user() && $request->user()->role_id !== 1) {
            return redirect('/user_dashboard'); // قم بتحديد المسار الذي سيتم توجيه المستخدم العادي إليه
        }

        return $next($request);
    }
}
