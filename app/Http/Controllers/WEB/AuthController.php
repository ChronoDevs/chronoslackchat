<?php

namespace App\Http\Controllers\WEB;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\AuthService;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;

class AuthController extends Controller
{
    /**
     * Returns resource of login page
     */
    public function index()
    {
        return view('pages.auth.login');
    }

    /**
     * Returns view of registration
     *
     * @return view
     */
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('web.top');
        }

        return view('pages.auth.register');
    }
}
