<?php

namespace App\Http\Controllers;

use function Illuminate\Events\queueable;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Events\OrderCreated;
use App\Jobs\ExportOrder;
use App\Jobs\UpdateOrder;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all()->toJson();

        return $orders;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->input());
        //do some pdf work to create invoice
        $order_code = rand(10000000, 99999999);
        $order->update([
            'code'    => $order_code,
            'invoice' => $order_code.'.pdf', //for example
        ]);

        $event = OrderCreated::dispatch($order);

        if($event) {
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
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * Export the specified orders to the API.
     *
     * @param  @array
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $orders = [];
        foreach ($request->orders as $key => $id) {
            $order = Order::find($id);
            ExportOrder::dispatch($order)->delay(10);
            updateOrder::dispatch($order)->delay(65);
            $orders[] = Order::find($id);
        }

        return json_encode($orders);
    }

}
