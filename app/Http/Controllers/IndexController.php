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

    public function session()
    {
        // return view('dashboard');
    }

    public function profile()
    {
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

    public function processRegister()
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        $c_password = $_POST['cpwd'];
        echo $fname, $lname, $email, $password, $c_password;
    }
}
