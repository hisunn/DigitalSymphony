<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\orderModel;
use Symfony\Component\VarDumper\VarDumper;

class orderController extends Controller
{


    public function viewOrder(Request $request)
    {
        $session_value = $request->session()->exists('users');
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

            $sql = DB::select('SELECT menu.menu_image AS item_image, orders.item_name AS item_name, orders.quantity AS item_quantity, orders.item_price AS item_price, orders.item_id AS item_id, orders.deleted_at AS deleted_at  FROM menu INNER JOIN orders ON menu.id = orders.item_id WHERE orders.user_id=' . $id . ' ORDER BY item_name');
         
            return view('layouts.order')
                ->with('sql', $sql);
        } else {
            return redirect(url('/login'));
        }
    }

    public function processPayment(Request $request)
    {
        if ($request->session()->exists('id')) {
            $id = auth()->user()->id;
            // echo "payment success";
            $sql = DB::select('SELECT menu.menu_image AS item_image, orders.item_name AS item_name, orders.quantity AS item_quantity, orders.item_price AS item_price, orders.item_id AS item_id FROM menu INNER JOIN orders ON menu.id = orders.item_id WHERE orders.user_id=' . $id . ' ORDER BY item_name');
            $total_quantity = DB::select('SELECT SUM(quantity) AS quantity FROM orders WHERE user_id=' . $id . ' LIMIT 1');
        } else {
            return redirect(url('/login'));
        }





        return view('listOrder')->with('sql', $sql)->with('total_quantity', $total_quantity);
    }


    public function insertOrder(Request $request)
    {
        // cara old skool
        // $order = new orderModel;
        // $menu = $_GET['foodtype'];
        // $menu_name = $_GET['foodname'];
        // $menu_amount = $_GET['amount'];
        // $menu_price = $_GET['price'];
        // $user_id = auth()->user()->id;
        // array(4) { ["price"]=> string(1) "4" ["foodname"]=> string(12) "French Fries" ["amount"]=> string(1) "1" ["foodtype"]=> string(1) "4" }

        // cara laravel     
        $id = auth()->user()->id;
        $data = $request->input();

        // select user_id and menu_name from orders table (method 1)
        $sql = DB::table('orders')->select(
            'user_id',
            'item_id'
        )->where('user_id', $id)->where('item_id', $data['foodtype'])->get();
        // select user_id and menu_name from orders table (method 2)
        // $sql = DB::select('select user_id, item_name from orders where user_id=' . $id);
        $user_id = '';
        $foodtype = '';
        foreach ($sql as $display) {
            $user_id = $display->user_id;
            $foodtype = $display->item_id;
        }
        if ($id == $user_id && $data['foodtype'] == $foodtype) {

            $sql = DB::table('orders')->select(
                'quantity'
            )->where('user_id', $id)->where('item_id', $data['foodtype'])->get();
            $quantity = '';
            foreach ($sql as $display) {
                $quantity = $display->quantity;
            }
            $new_quantity = $quantity + $data['amount'];
            $sql = DB::table('orders')->where('user_id', $id)->where('item_id', $data['foodtype'])->update(['quantity' => $new_quantity, 'updated_at' => now()]);
        } else {
            // insert menu into orders table
            $sql = DB::table('orders')->insert([
                'user_id' => auth()->user()->id,
                'item_id' => $data['foodtype'],
                'item_name' => $data['foodname'],
                'item_price' => $data['price'],
                'quantity' => $data['amount'],
                'quantity_temp' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        // sini
        $sql = DB::select('SELECT SUM(quantity) as quantity from orders where user_id=' . auth()->user()->id);
        // $sql = DB::select('SELECT COUNT(*) AS quantity FROM orders WHERE user_id=' . auth()->user()->id . ' AND deleted_at IS NULL');
        foreach ($sql as $display) {
        }
        if ($display->quantity == NULL || $display->quantity == '') {
            $display->quantity = 0;
        }

        return $display->quantity;
    }

    public function deleteItem()
    {
        $item_id = $_GET['item_id'];
        $id = auth()->user()->id;
        $sql = DB::delete('DELETE FROM orders WHERE user_id=' . $id . ' AND item_id=' . $item_id);
        $sql = DB::select('SELECT SUM(quantity) as quantity from orders where user_id=' . auth()->user()->id);

        foreach ($sql as $display) {
        }
        if ($display->quantity == null || $display->quantity == '') {
            $display->quantity = 0;
        }
        return redirect(url('/order-list?quantity=' . $display->quantity));
    }

    public function updateOrder(Request $request)
    {
        $data = $request->input();
        $id = auth()->user()->id;
        // var_dump($data['key1']);



        if (isset($data['key1'])) {
            $key1 = $data['key1'];
            $sql = DB::update('UPDATE orders SET quantity=' . $key1 . ' WHERE item_id=1 AND user_id=' . $id);
        }
        if (isset($data['key2'])) {
            $key2 = $data['key2'];
            $sql = DB::update('UPDATE orders SET quantity=' . $key2 . ' WHERE item_id=2 AND user_id=' . $id);
        }
        if (isset($data['key3'])) {
            $key3 = $data['key3'];

            $sql = DB::update('UPDATE orders SET quantity=' . $key3 . ' WHERE item_id=3 AND user_id=' . $id);
        }
        if (isset($data['key4'])) {
            $key4 = $data['key4'];
            $sql = DB::update('UPDATE orders SET quantity=' . $key4 . ' WHERE item_id=4 AND user_id=' . $id);
        }


        return redirect(url('/payment-gateway'));
    }

    public function paidOrder()
    {
        $id = auth()->user()->id;
        $sql = DB::update('UPDATE orders SET paid_at=CURRENT_TIMESTAMP() WHERE user_id=' . $id);


        $sql = DB::select('SELECT user_id, item_id, item_name, item_price, quantity, paid_at FROM orders WHERE user_id= ' . $id . ' ORDER BY item_id');

        foreach ($sql as $value) {

            DB::insert('INSERT INTO orders_history (user_id, item_id, item_name, item_price, quantity, paid_at ) VALUES(' . $value->user_id . ',' . $value->item_id . ',"' . $value->item_name . '",' . $value->item_price . ',' . $value->quantity . ', CURRENT_TIMESTAMP()' . ' )');
        }

        $sql = DB::delete('DELETE FROM orders WHERE user_id=' . $id);


        return redirect(url('/successOrder'));
    }

    public function successOrder(Request $request)
    {
        if ($request->session()->exists('id')) {
            return view('layouts.success');
        } else {
            return redirect(url('/'));
        }
    }

    public function deleteOrder()
    {
        $id = auth()->user()->id;
        // $item_id = $_GET['item_id'];
        $order = orderModel::where('user_id', $id)->delete();


        $sql = DB::select('SELECT COUNT(*) AS counter FROM orders WHERE user_id=' . $id . ' AND deleted_at IS NULL LIMIT 1');

        foreach ($sql as $counter) {
            # code...
        }
        $counter = $counter->counter;

        if ($counter == 0) {
            # code...
            // var_dump($counter);

            $sql = DB::select('SELECT quantity,item_id FROM orders WHERE user_id=' . $id . ' ORDER BY item_id ASC');

            foreach ($sql as $value) {

                $sql = DB::update('UPDATE orders SET quantity_temp=' . $value->quantity . ' WHERE user_id=' . $id . ' AND item_id=' . $value->item_id);
                $sql = DB::update('UPDATE orders SET quantity=0 WHERE user_id=' . $id . ' AND item_id=' . $value->item_id);
            }
        }



        // echo "hello";
        return redirect(url('/payment-gateway'));
        // return view('dashboard');
    }

    public function restoreOrder()
    {
        $id = auth()->user()->id;
        // $item_id = $_GET['item_id'];
        $order = orderModel::withTrashed()->where('user_id', $id);
        $order->restore();

        $sql = DB::select('SELECT COUNT(*) AS counter FROM orders WHERE user_id=' . $id . ' AND deleted_at IS NULL LIMIT 1');

        foreach ($sql as $counter) {
            # code...
        }
        $counter = $counter->counter;

        if ($counter > 0) {
            # code...
            // var_dump($counter);

            $sql = DB::select('SELECT quantity_temp,item_id FROM orders WHERE user_id=' . $id . ' ORDER BY item_id ASC');

            foreach ($sql as $value) {

                $sql = DB::update('UPDATE orders SET quantity=' . $value->quantity_temp . ' WHERE user_id=' . $id . ' AND item_id=' . $value->item_id);
                $sql = DB::update('UPDATE orders SET quantity_temp=0 WHERE user_id=' . $id . ' AND item_id=' . $value->item_id);
            }
        }

        // echo "hello";
        return redirect(url('/payment-gateway'));
    }

    public function viewHistory(Request $request)
    {
        if ($request->session()->exists('id')) {
            $sql = DB::select('SELECT DISTINCT paid_at FROM orders_history WHERE user_id=' . auth()->user()->id . ' ORDER BY paid_at DESC');
            $sql2 = DB::select('SELECT DISTINCT COUNT(paid_at) AS history_count FROM orders_history WHERE user_id=' . auth()->user()->id . ' ORDER BY paid_at DESC LIMIT 1');
            return view('layouts.history')->with('sql', $sql)->with('sql2', $sql2);
        } else
            return redirect(url('/login'));
    }
}
