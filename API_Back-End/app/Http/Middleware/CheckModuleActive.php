<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserModule;

class CheckModuleActive
{
    public function handle(Request $request, Closure $next, $moduleId)
    {
        $user = $request->user();

        $isActive = UserModule::where('user_id', $user->id)
            ->where('module_id', $moduleId)
            ->where('active', true)
            ->exists();

        if (!$isActive) {
            return response()->json([
                'error' => 'Module inactive. Please activate this module to use it.'
            ], 403);
        }

        return $next($request);
    }
}