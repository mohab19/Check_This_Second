<?php

namespace App\Services;

use App\Models\Order;

interface ShipCompanyStrategy {

    /**
     * Register order shipment with curl request
     *
     * @return Bolean
     */
    public function register_shipment(Order $order);

    /**
     * Retreive shipment status with curl request
     *
     * @return Bolean
     */
    public function update_shipment(Order $order);

}