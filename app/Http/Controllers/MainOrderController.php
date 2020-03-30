<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MainOrder;
use App\Order;
use App\OrderPosition;

class MainOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Gate::allows('isProduction'))
        {
            if(request()->has('archive')){
                return view('panel.production.index_archive', ['orders' => Order::where([['archive','=','1'],['accepted','=','1']])->get()]);
            }else{
                return view('panel.production.index', ['orders' => Order::where([['archive','=','0'],['accepted','=','1']])->get()]);
            }
        }elseif(\Gate::allows('isOffice') || \Gate::allows('isAdmin')){
            if(request()->has('archive')){
                return view('panel.office.index', ['main_orders' => MainOrder::where('archive','1')->get()]);
            }else{
                return view('panel.office.index', ['main_orders' => MainOrder::where('archive','0')->get()]);
            }
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('panel.office.show_main_order',['orders' => Order::where('main_order_id','=',MainOrder::where('id' ,'=', $id )->pluck('dok_id'))->get(), 'mainOrder' => MainOrder::where('id' ,'=', $id )->first()]);
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
    public function update(Request $request, $id)
    {
        //
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

    public function accept($id)
    {
        $mainOrder = MainOrder::where('id','=',$id)->first();
        $mainOrder->accepted = 1;
        $mainOrder->save();

        $orders = Order::where('main_order_id','=',$mainOrder->dok_id)->get();
        foreach($orders as $order)
        {
            $order->accepted_date = now();
            $order->accepted = 1;
            $order->save();
        }

        return redirect()->back();
    }

    public function redeem($id)
    {
        $mainOrder = MainOrder::where('id','=',$id)->first();
        $ordersNew = Order::where('main_order_id','=',$mainOrder->dok_id)->where('status','nowe')->get();
        $ordersInProduction = Order::where('main_order_id','=',$mainOrder->dok_id)->where('status','w produkcji')->get();

        foreach ($ordersInProduction as $order) {
            $order->quantity_left = $order->quantity - $order->in_production_quantity - $order->done_quantity;
        }

        return view('panel.office.redeem',['mainOrder' => $mainOrder,
                                            'ordersNew' => $ordersNew,
                                            'ordersInProduction' => $ordersInProduction]);
    }
}
