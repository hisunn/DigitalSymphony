<?php

namespace App\Http\Controllers;

use App\Models\menuModel;
use App\Models\orderModel;
use Illuminate\Http\Request;
// use all DB
use Illuminate\Support\Facades\DB;

class menuController extends Controller
{
    public function viewMenu(Request $request)
    {
        session([
            'id' => auth()->user()->id,
            'username' => auth()->user()->name,
        ]);

        if ($request->session()->exists('id')) {
            $menu = menuModel::all();
            return view('dashboard', ['menu' => $menu]);
        } else
            return view("/");
    }

    public function viewDetails(Request $request)
    {
     
        if ($request->session()->exists('id')) {

            $id = auth()->user()->id;

            $quantity = DB::select('SELECT SUM(quantity) AS quantity FROM orders WHERE user_id=' . $id . ' LIMIT 1');
            $quantity_temp = DB::select('SELECT SUM(quantity_temp) AS quantity_temp FROM orders WHERE user_id=' . $id . ' LIMIT 1');

            foreach ($quantity as $quantity) {
            }
            foreach ($quantity_temp as $quantity_temp) {
            }

            $order_quantity = $quantity->quantity;
            $order_quantity_temp =  $quantity_temp->quantity_temp;
            
            if ($order_quantity_temp > 0) {

                return redirect(url('/payment-gateway'));
            }

            $menu_type = $_GET['type'];

            $menu = menuModel::where('id', '=', $menu_type)->get();

            return view('layouts.food', ['details' => $menu]);
        } else
            return redirect(url('/login'));
    }


    public function setting(Request $request)
    {
        if ($request->session()->exists('id')) {

            return view('settingDetails');
        } else
            return redirect(url('/login'));
    }
}
