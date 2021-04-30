<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Client;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all()->toArray();
        return array_reverse($orders);
    }

    public function store($email)
    {
        $client = Client::where('email', $email)->first();

        if (!$client){

            $cli = new Client([
                'email' => $email,
                'name' => ''
            ]);
            $cli->save();

            $cli->orders()->create([
                'email' => $email,
                'name' => ""
            ]);
        }
        else{
            $client->orders()->create([
                'email' => $email,
                'name' => $client->name,
            ]);
        }

        return response()->json('Order created!');
    }

    public function show($id)
    {
        $order = Order::find($id);
        return response()->json($order);
    }

    public function update($id, Request $request)
    {
        $order = Order::find($id);
        $order->update($request->all());

        return response()->json('Order updated!');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return response()->json('Order deleted!');
    }
}
