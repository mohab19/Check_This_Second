<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Bus;
use App\Jobs\ExportOrder;
use App\Jobs\UpdateOrder;
use App\Models\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_orders_api_exists()
    {
        $response = $this->get('/api/orders');

        $response->assertStatus(200);
    }

    public function test_orders_api_returns_json()
    {
        $response = $this->json('GET', 'api/orders');

        $response->assertJsonStructure([
            '*' => [
                "id"		 ,
                "user_id" 	 ,
                "code"   	 ,
                "price" 	 ,
                "taxes" 	 ,
                "total"      ,
                "invoice"    ,
                "awb"        ,
                "printed"    ,
            ]
        ]);
    }

    public function test_post_orders_api_creates_order()
    {
        $order = [
            "user_id" 	 => 1,
            "code"   	 => rand(10000000, 99999999),
            "price" 	 => rand(100, 999),
            "taxes" 	 => rand(10, 99),
            "total"      => rand(100, 999),
            "status_id"  => 1,
        ];
        $response = $this->json('post', 'api/orders', $order);

        $response->assertStatus(200);
    }

    public function test_orders_can_be_exported()
    {

        $orders   = array(
            'orders' => array(0 => 1)
        );
        $response = $this->json('post', 'api/export_orders', $orders);

        $response->assertStatus(200);
    }

    public function test_orders_jobs_can_be_dispatched()
    {
        $order = Order::factory()->create();
        Bus::fake();

        ExportOrder::dispatch($order);
        Bus::assertDispatched(ExportOrder::class);

        UpdateOrder::dispatch($order);
        Bus::assertDispatched(UpdateOrder::class);
    }
}
