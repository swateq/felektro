<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MainOrder;
use App\Order;

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
                return view('panel.production.index', ['orders' => Order::where('archive','1')->get()]);
            }else{
                return view('panel.production.index', ['orders' => Order::where('archive','0')->get()]);
            }
        }elseif(\Gate::allows('isOffice')){
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
        return view('panel.office.show_main_order',['orders' => MainOrder::findOrFail($id)->orders]);
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
}
