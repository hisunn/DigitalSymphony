<?php

namespace App\Http\Controllers;

use App\Models\menuModel;
use App\Models\orderModel;
use Illuminate\Http\Request;
// use all DB
use Illuminate\Support\Facades\DB;

class menuController extends Controller
{
    public function viewMenu()
    {
        $menu = menuModel::all();
        return view('dashboard', ['menu' => $menu]);
    }

    public function viewDetails()
    {
        $menu_type = $_GET['type'];

        $menu = menuModel::where('id', '=', $menu_type)->get();

        return view('layouts.food', ['details' => $menu]);
    }

    public function insertOrder()
    {
        $order = new orderModel;
        $menu = $_GET['foodtype'];
        $menu_name = $_GET['foodname'];
        $menu_amount = $_GET['amount'];
        $menu_price = $_GET['price'];
        $user_id = auth()->user()->id;
        DB::table('order')->insert([]);
        var_dump($menu_name);
    }

    public function setting()
    {
        return view('settingDetails');
    }
}
