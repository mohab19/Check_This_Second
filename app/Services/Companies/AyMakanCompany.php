<?php

namespace App\Services\Companies;

use App\Repository\OrderRepositoryInterface;
use App\Services\ShipCompanyStrategy;
use App\Models\Order;

class AyMakanCompany implements ShipCompanyStrategy
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function register_shipment(Order $order) : bool
    {
        // begin curl reguest and post follow_shipment
        logger("Order " . $order->id . " shipment Registered!");
        $awb = 'awb_link_' . $order->code;
        $this->orderRepository->update($order->id, 'awb', $awb);

        return true;
    }

    public function update_shipment(Order $order) : bool
    {
        // request status update on an order
        logger("Order " . $order->id . " shipment status updated!");
        $new_status = $order->status_id + 1;
        $this->orderRepository->update($order->id, 'status_id', $new_status);

        return true;
    }

}
