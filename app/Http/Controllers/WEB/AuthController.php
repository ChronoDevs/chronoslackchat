<?php

namespace App\Http\Controllers\WEB;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\AuthService;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use Session;
use App\Models\Channel;
use App\Models\User;
use App\Models\Role;

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
     * Login user
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('web.channels.index'));
        }

        return back()->with('error', 'The provided credentials do not match our records.');
    }

    /**
     * Returns view of registration
     *
     * @return view
     */
    public function create()
    {
        $channels = Channel::list();
        $users = User::list();
        $roles = Role::list();

        if (Auth::check()) {
            return view('pages.auth.register', compact('channels', 'users', 'roles'));
        }

        return redirect()->route('web.home');
    }
    
    /**
     * Create a user
     */
    public function store(RegistrationRequest $request)
    {
        $params = $request->validated();
        User::register($params);

        return back()->with('success', 'Registered Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $channels = Channel::list();
        $roles = Role::list();
        
        return view('pages.auth.edit', compact('user', 'roles', 'channels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegistrationRequest $request, User $user)
    {
        $params = $request->validated();
        User::updater($user, $params);

        return redirect()->route('users.create')->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->deleter();

        return back()->with('success', 'Deleted Successfully!');
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('web.auth.login');
    }
}
