<?php

namespace EMedia\DeviceAuthentication\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use EMedia\DeviceAuthentication\Entities\Device;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            abort(401, 'Unauthorized');
        }

        $user = auth('api')->user();
        // record device data
        if ($request->has(['device_id', 'device_type', 'device_push_token'])) {
            $device = Device::where([
                'device_id' => $request->device_id,
                'device_type' => $request->device_type
            ])->first();

            if ($device) {
                $device->update([
                    'user_id' => $user->id,
                    'device_push_token' => $request->device_push_token,
                ]);
            } else {
                $device = Device::create([
                    'user_id' => $user->id,
                    'device_id' => $request->device_id,
                    'device_type' => $request->device_type,
                    'device_push_token' => $request->device_push_token,
                ]);
            }
        }

        header('Authorization: Bearer ' . $token);

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $output = $this->respondWithToken(auth('api')->refresh());
        return response($output)
            ->header('Authorization', 'Bearer ' . $output['access_token']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'data' => auth('api')->user(),
        ];
    }
}
