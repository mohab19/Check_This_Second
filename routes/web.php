<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\ExportOrder;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $order = Order::first();
    dispatch(new ExportOrder($order));

    return 'Finished!';
});
