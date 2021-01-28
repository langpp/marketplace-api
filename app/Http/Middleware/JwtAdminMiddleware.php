<?php
namespace App\Http\Middleware;
use Closure;
use Exception;
use App\Models\Users;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtAdminMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken();
        
        if(!$token) {

            /*
            |--------------------------------------------------------------------------
            | Unauthorized response if token not there.
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => false,
                'message' => 'Token not provided.'
            ], 401);
        }

        try {
            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        } catch(ExpiredException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Provided token is expired.'
            ], 400);
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error while decoding token.'
            ], 400);
        }

        /*
        |--------------------------------------------------------------------------
        | Check the role.
        |--------------------------------------------------------------------------
        */

        // if ($credentials->role != 1 || $credentials->role != 2) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Unauthorized.'
        //     ], 401);
        // }

        $user = Users::find($credentials->sub);

        /*
        |--------------------------------------------------------------------------
        | Now let's put the user in the request class so that you can grab it from
        | there.
        |--------------------------------------------------------------------------
        */
        
        $request->auth = $user;
        return $next($request);
    }
}