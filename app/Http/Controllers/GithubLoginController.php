<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('github')->user();
            $git_user = User::updateOrCreate([
                    'github_id' => $user->id,
                ],
                [
                    'github_id' => $user->id,
                    'name' => $user->name,
                    'nickname' => $user->nick_name,
                    'email' => $user->email,
                    'github_token' => $user->token,
                    'auth_type' => 'github',
                    'password' => bcrypt('password'),
                ]);
            Auth::login($git_user);
            return redirect()->route('dashboard');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
