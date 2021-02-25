<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * Change password
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);

        $user = User::find(Auth::id());
        // dd($user->password);die;
        if (!Hash::check($request->current, $user->password)) {
            return response()->json(['status' => false,'element' => 'current', 'message' => 'Mật
                khẩu hiện tại không đúng']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['status' => true, 'message' => 'Cập nhật mật khẩu thành công']);
    }
}
