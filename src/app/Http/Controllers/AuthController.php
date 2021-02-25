<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $providers = ['facebook', 'google'];

    /**
     * @param $driver
     * @return \Illuminate\Http\JsonResponse
     */
    public function redirect($driver)
    {
        if (!$this->isProviderAllowed($driver)) {
            return $this->sendFailedResponse("{$driver} is not currently supported");
        }

        session(['back_url' => request()->get('back_url', config('app.url'))]);

        if (auth()->check()) {
            return response()->json(['logged' => true]);
        }

        return response()->json([
            'logged' => false,
            'url' => Socialite::driver($driver)->redirect()->getTargetUrl(),
        ]);
    }

    /**
     * Obtain the user information from provider.
     *
     * @param $driver
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function callback($driver)
    {
        $backUrl = session('back_url');
        session()->forget('back_url');

        try {
            $socialUser = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return redirect()->to($backUrl);
        }
        
        $existingUser = User::query()->where('email', $socialUser->getEmail())->first();
        if ($existingUser) {
            auth()->login($existingUser, true);
            return redirect()->to($backUrl);
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

            auth()->login($user, true);
            DB::commit();

            return redirect()->to($backUrl);
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error($e);

            throw $e;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * @param null $msg
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendFailedResponse($msg = null)
    {
        return response()->json([
            'error' => true,
            'message' => $msg ?: 'Unable to login, try with another provider to login.',
        ]);
    }

    /**
     * @param $driver
     * @return bool
     */
    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers);
    }
}
