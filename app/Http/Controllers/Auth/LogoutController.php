<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
class LogoutController extends Controller
{
    public function getIndex()
    {
        if (!auth()->check()) {
            abort(401);
        }
        auth()->logout();
        session()->flush();
        return redirect("/login");
    }
}