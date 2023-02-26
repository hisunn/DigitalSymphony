@php
    use Illuminate\Support\Facades\DB;
    
    $id = auth()->user()->id;
    $order_value = DB::select('SELECT quantity,quantity_temp FROM orders WHERE user_id=' . $id);
    
    foreach ($order_value as $value) {
    }
    
    $is_ordering = $value->quantity + $value->quantity_temp;
    if (isset($is_ordering)) {
        redirect(url('/payment-gateway'));
    }
    
@endphp
