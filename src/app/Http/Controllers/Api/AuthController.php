<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends BaseController
{
    /**
     * Return login URL
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUrl()
    {
        return response()->json(['url' => Socialite::driver('google')
            ->with(["access_type" => "offline", "prompt" => "consent select_account"])
            ->stateless()
            ->redirect()
            ->getTargetUrl()]);
    }

    /**
     * @param $driver
     * @return \Illuminate\Http\JsonResponse
     */
    public static function login($driver)
    {
        // Check token
        $token = request()->get('identity_token');

        if (empty($token)) {
            return response()->json(['error' => true, 'message' => 'Invalid Token']);
        }

        try {
            $socialUser = Socialite::driver($driver)->userFromToken($token);
        } catch (\Exception $exception) {
            return response()->json(['error' => true, 'message' => 'Invalid Token']);
        }

        /**
         * @var \Laravel\Socialite\Contracts\User $socialUser
         * we have successfully authenticated via facebook at this point and can use the provider user to log us in.
         * Check if a user exists with the email and if so, log them in.
         */
        $user = User::query()->firstOrNew([
            'email' => $socialUser->getEmail(),
            'social_id' => $socialUser->getId(),
            'social_provider' => 'google'
        ]);

        if ($user->exists) {
            $token = JWTAuth::fromUser($user);

            return response()->json(['error' => false, 'token' => $token, 'user' => new UserResource($user)]);
        }

        DB::beginTransaction();

        try {
            $uuid = Uuid::uuid4();

            $user = User::query()->create([
                'uuid' => $uuid,
                'social_id' => $socialUser->getId(),
                'social_provider' => $driver,
                'nick_name' => '',
                'full_name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'email_verified_at' => now(),
                'profile_url' => $socialUser->getAvatar(),
                'role_id' => 2,
            ]);
            DB::commit();

            $token = JWTAuth::fromUser($user);
            
            return response()->json(['error' => false, 'token' => $token, 'user' => new UserResource($user)]);
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error($e);

            return response()->json(['error' => true, 'message' => 'Login error']);
        }
    }


    /**
     * Refresh a token.
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            return response()->json(['token' => JWTAuth::parseToken()->refresh()]);
        } catch (\Exception $exception) {
            return response()->json(['error' => true, 'message' => 'Invalid Token']);
        }
    }
}
