<?php
namespace App\Http\Controllers\Auth;
use App\Services\Auth\LoginService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\User;
class LoginController extends Controller
{
    public LoginService $loginService;
    public function __construct(
    ) {
    }
    public function login(LoginRequest $request)
    {
        $executeLogin = auth()->attempt([
            "email" => $request->email,
            "password" => $request->password,
        ]);
        if (!$executeLogin) {
                return redirect()->back()
                    ->withInput()
                    ->with("info", "password salah");
        }
        if(auth()->user()->active == 0){
            return redirect()->back()
                ->withInput()
                ->with("info", "this account is inactive");
        }
        return redirect("dashboard");
    }
    public function getIndex()
    {
        return view("auth.login");
    }
    public function postIndex(LoginRequest $request)
    {
        return $this->login($request);
    }
}