<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\MainOrder;

class OrderController extends Controller
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
                return view('panel.production.index_archive', ['orders' => Order::where([['archive','=','1'],['accepted','=','1'],['client_type','!=','export']])->get()]);
            }else{
                return view('panel.production.index', ['orders' => Order::where([['archive','=','0'],['accepted','=','1'],['client_type','!=','export']])->get()]);
            }
        }elseif(\Gate::allows('isOffice') || \Gate::allows('isAdmin')){
            return view('panel.office.index_order', ['orders' => Order::all()]);
        }
    }

    public function indexExport()
    {
        if(\Gate::allows('isProduction'))
        {
            if(request()->has('archive')){
                return view('panel.production.index_archive', ['orders' => Order::where([['archive','=','1'],['accepted','=','1'],['client_type','=','export']])->get()]);
            }else{
                return view('panel.production.index', ['orders' => Order::where([['archive','=','0'],['accepted','=','1'],['client_type','=','export']])->get()]);
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
        return view('panel.office.show_order',['order' => Order::where('id',$id)->first(),'orderPositions' => Order::findOrFail($id)->order_positions]);
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

    public function findFamilliar($prod_id)
    {
        return Order::where('product_id', $prod_id)
            ->where('status', 'nowe')->get();
    }
}
