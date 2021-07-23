<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'   => rand(1, 10),
            'code'      => rand(10000000, 99999999),
            'price'     => rand(100, 1000),
            'taxes'     => rand(10, 50),
            'total'     => rand(1000, 1050),
            'status_id' => 1,
            'invoice'   => "",
            'awb'       => "",
            'printed'   => 0,
        ];
    }
}
