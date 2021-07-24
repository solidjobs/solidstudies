<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function authenticate(Request $request, Response $response)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->start();
            $request->session()->regenerate();
            /** @var User $user */
            $user = $request->user();
            $user->api_token = $request->session()->getId();
            $user->save();

            return $response->setContent([
                'session' => $request->session()->getId()
            ]);
        }

        return $response->setContent([
            'email' => 'The provided credentials do not match our records.',
        ])->setStatusCode(401);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
