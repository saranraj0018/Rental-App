<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class RegisterPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response instanceof JsonResponse) {
            // Get the existing data
            $data = $response->getData(true);

            // Add extra data
            $data['permissions'] = getAdminPermissions();

            // Set the modified data back to the response
            $response->setData($data);
        }

        return $response;
    }
}
