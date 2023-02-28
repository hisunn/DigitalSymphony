<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    
    public function index()
    {
        return view('auth.login');
    }


    public function processLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        echo  $email, $password;
    }
    public function logout(Request $request)
    {
        $request->session()->forget(['id','username']);
        return view("/");

    }


    public function test(Request $request)
    {
        // Testing Output Area
        // var_dump(session('status'));
        // if ($request->session()->exists('users')) {
        //     // will return true even the value is null
        // }
        var_dump($request->session()->get('id'));
        var_dump($request->session()->get('username'));
        var_dump(session('id'));
        // return view('test');
    }
}
