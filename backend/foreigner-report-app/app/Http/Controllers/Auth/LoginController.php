<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログイン後の戻り値をカスタマイズ
     * @param Request $request リクエスト情報
     * @param object $user ユーザー
     */
    public function authenticated(Request $request, $user)
    {
        \Log::debug('Authチェック');
        \Log::debug(Auth::user());
        \Log::debug('$userチェック');
        \Log::debug($user);
        return $user;
    }

    /**
     * ログアウト時の戻り値をカスタマイズ
     */
    private function loggedOut(Request $request)
    {
        $request->session()->regenerate();
        return response()->json();
    }
}
