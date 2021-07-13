<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GithubAuthController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('github')->user();
        //dd($user);

        // DB에 사용자 정보를 저장한다. 
        // 이미 이 사용자가 저장되어 있다면
        // 저장할 필요가 없다. 

        $user = User::firstOrCreate(
            [ // email이 없으면 email을 포함해서 아랫것들을 추가. 있으면 전부 추가안함
                //create를 하면 자동 save임

                'email' => $user->getEmail()
            ],
            [
                'password' => Hash::make(Str::random(24)), //not null이기 때문에 비워둘 수 없음
                'name' => $user->getName()
            ]
        );

        // 로그인 처리
        Auth::login($user);

        return redirect()->intended('/dashboard');
        // 로그인 후에 원래의 사이트로 돌려줌. 근데 원래 사이트가 없으면 dashboard로.
    }
}
