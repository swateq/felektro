<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderPosition;

class OrderPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('panel.production.order_position',['order' => Order::findOrFail($id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orderPosition = new OrderPosition;
        $orderPosition->order_id = $request->order_id;
        $orderPosition->worker = $request->worker;
        $orderPosition->quantity = $request->quantity;
        $orderPosition->save();
        $this->updateThisInProductionQuantity($request->order_id,$request->quantity);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('panel.production.doing_order_position',['order_positions' => Order::findOrFail($id)->order_positions, 'order' => Order::findOrFail($id) ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $orderPosition = OrderPosition::findOrFail($id);

        $orderPosition->status = "zrobione";
        $orderPosition->save();

        $this->updateThisDoneQuantity($orderPosition->order_id,$orderPosition->quantity);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateThisInProductionQuantity($order_id, $quantity)
    {
        $order = Order::findOrFail($order_id);
        $order->in_production_quantity = $order->in_production_quantity + $quantity;
        $order->status = 'w produkcji';
        $order->save();
    }

    public function updateThisDoneQuantity($order_id, $quantity)
    {
        $order = Order::findOrFail($order_id);
        $order->done_quantity = $order->done_quantity + $quantity;
        $order->in_production_quantity = $order->in_production_quantity - $quantity;

        if(($order->quantity - $order->done_quantity) == '0')
        {
            $order->archive = '1';
            $order->status = "gotowe";
        }
        $order->save();
    }
}
