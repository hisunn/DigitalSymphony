<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{

    public function show(Request $request, $id)
    {
        $request->session()->put('key', 'value');
    }
}
