<?php

namespace App\Services;

use App\Repository\OrderRepositoryInterface;
use function Illuminate\Events\queueable;
use App\Jobs\ExportOrder;
use App\Jobs\UpdateOrder;

class OrderService
{

	private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

	/**
    * @return Json collection
    */
	public function ListOrders()
    {
        $orders = $this->orderRepository->all();

        return json_encode($orders);
    }

	/**
    * @return Json entity
    */
	public function getOrder(int $id)
    {
        $order = $this->orderRepository->where('id', $id);

        return json_encode($order);
    }

	/**
    * @return Json response
    */
	public function createOrder(array $order = [])
	{
        //do some pdf work to create invoice
        $order['code'] 	  = rand(10000000, 99999999);
        $order['invoice'] = $order['code'].'.pdf'; //for example

		$order = $this->orderRepository->create($order);

		ExportOrder::dispatch($order)->delay(5);
		updateOrder::dispatch($order)->delay(60);

        if($order) {
            return response()->json([
                'status'  => 200,
                'message' => 'Order registered Successfuly'
            ]);
        } else {
            return response()->json([
                'status'  => 400,
                'message' => 'Order registeration Faild'
            ]);
        }
	}

	/**
    * @return Json collection
    */
	public function ExportOrder(array $orders)
	{
		$orders_updated = [];
        foreach ($orders as $key => $id) {
            $order = $this->orderRepository->find($id);
            ExportOrder::dispatch($order)->delay(5);
            updateOrder::dispatch($order)->delay(60);
            $orders_updated[] = $this->orderRepository->find($id);
        }

        return json_encode($orders);
	}

}
