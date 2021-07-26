<?php

namespace App\Http\Controllers\Companies;

use App\Services\ShipCompanyInterface;
use App\Models\Order;

class AyMakanCompany implements ShipCompanyInterface
{

    public function register_shipment($order)
    {
        // begin curl reguest and post follow_shipment
        logger("Order " . $order->id . " shipment Registered!");

        $order->update([
            'awb' => 'awb_link_' . $order->code,
        ]);

        return true;
    }

    public function update_shipment($order_code)
    {
        $order = Order::where('code', $order_code)->first();
        // request status update on an order
        logger("Order " . $order->id . " shipment status updated!");
        $new_status = $order->status_id + 1;
        $order->update([
            'status_id' => $new_status,
        ]);

        return true;
    }

}
