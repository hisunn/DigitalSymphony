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
        $id = auth()->user()->id;
        // $order_value = DB::select('SELECT (quantity+quantity_temp) AS total FROM orders WHERE user_id=' . $id . ' LIMIT 1');

        $quantity = DB::select('SELECT SUM(quantity) AS quantity FROM orders WHERE user_id=' . $id . ' LIMIT 1');
        $quantity_temp = DB::select('SELECT SUM(quantity_temp) AS quantity_temp FROM orders WHERE user_id=' . $id . ' LIMIT 1');

        foreach ($quantity as $quantity) {
        }
        foreach ($quantity_temp as $quantity_temp) {
        }

        $order_quantity = $quantity->quantity;
        $order_quantity_temp =  $quantity_temp->quantity_temp;


        $is_ordering = $order_quantity + $order_quantity_temp;

        if ($order_quantity_temp > 0) {

            return redirect(url('/payment-gateway'));
        }

        $menu_type = $_GET['type'];

        $menu = menuModel::where('id', '=', $menu_type)->get();

        return view('layouts.food', ['details' => $menu]);
    }


    public function setting()
    {
        return view('settingDetails');
    }
}
