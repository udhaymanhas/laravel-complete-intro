<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getDashboard()
    {
        // First show old method with checks in each function (see authenticate video)
        return view('admin.dashboard');
    }

    public function getPostsIndex()
    {
        return view('admin.posts');
    }

    public function getContactIndex()
    {
        return view('admin.contact');
    }

    public function postLogin(Request $request)
    {
        if (!isset($request['email']) || strlen($request['email']) === 0 || !isset($request['password']) || strlen($request['password']) === 0) {
            return redirect()->back()->with(['fail' => 'Please provide an email address as well as a password!']);
        }
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->back()->with(['fail' => 'You could not be logged in. Please check your login credentials!']);
        }

        return redirect()->route('admin.dashboard');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}