<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MainOrder;
use App\Order;
use App\Exports\RedeemExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class MainOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * 14
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Gate::allows('isProduction'))
        {
            return view('panel.production.start');
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
        $validator = Validator::make($request->all(),[
            'accepted_date' => array(
                'required',
                'regex:/[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]/'
            )]);
        if($validator->fails())
        {
            toast('Format daty niepoprawny!','error')->autoClose(5000)->position('top-end')->timerProgressBar();
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $mainOrder = MainOrder::where('id',$id)->first();

        MainOrder::where('id',$mainOrder->id)->update(['accepted_date' => $request->accepted_date]);
        toast('Data akceptacji zmieniona!','success')->autoClose(5000)->position('top-end')->timerProgressBar();
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

    public function accept($id)
    {
        $mainOrder = MainOrder::where('id','=',$id)->first();
        $mainOrder->accepted = 1;
        $mainOrder->status = 'zaakceptowane';
        $mainOrder->accepted_date = now();
        $mainOrder->save();

        $orders = Order::where('main_order_id','=',$mainOrder->dok_id)->get();
        foreach($orders as $order)
        {
            $order->accepted_date = now();
            $order->accepted = 1;
            $order->status = 'zaakceptowane';
            $order->save();
        }

        return redirect()->back();
    }

    public function redeem($id)
    {
        $mainOrder = MainOrder::where('id','=',$id)->first();
        $ordersNew = Order::where('main_order_id','=',$mainOrder->dok_id)->where('status','nowe')->get();
        $ordersInProduction = Order::where('main_order_id','=',$mainOrder->dok_id)->where('status','w trakcie realizacji')->get();

        foreach ($ordersInProduction as $order) {
            $order->quantity_left = $order->quantity - $order->in_production_quantity - $order->done_quantity;
        }

        return view('panel.office.redeem',['mainOrder' => $mainOrder,
                                            'ordersNew' => $ordersNew,
                                            'ordersInProduction' => $ordersInProduction]);
    }

    public function redeemExport($id)
    {
        return Excel::download(new RedeemExport($id), 'redeem.xlsx');

    }
}
