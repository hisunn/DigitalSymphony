<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
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
    public function viewRegister()
    {

        return view('register');
    }


    public function test(Request $request)
    {
        // var_dump(session('status'));

        var_dump($request->session()->all());
        // return view('test');
    }
}
