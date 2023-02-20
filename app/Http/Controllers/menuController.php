<?php

namespace App\Http\Controllers;

use App\Models\menuModel;
use Illuminate\Http\Request;

class menuController extends Controller
{
    public function viewMenu()
    {
        $menu = menuModel::all();
        return view('layouts.menu', ['menu' => $menu]);
    }

    public function viewDetails()
    {
        $menu_type = $_GET['type'];

        $menu = menuModel::where('id', '=', $menu_type)->get();

        return view('layouts.food', ['details' => $menu]);
    }

    public function insertOrder()
    {
        $order = $_GET['foodtype'];
        $order_count = $_GET['amount'];


        var_dump($order, $order_count);
    }
}
