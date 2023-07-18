<?php

namespace App\Http\Controllers\WEB;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('web.home');
        }
        
        return redirect()->route('web.auth.login');
    }
}
