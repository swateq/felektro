<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\MainOrder;

class PanelController extends Controller
{
    public function index(){
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

    public function showMainOrder($id)
    {
        return view('panel.office.show_main_order',['orders' => MainOrder::find($id)->orders]);
    }

    public function showOrder($id)
    {
        return view('panel.office.show_order',['order' => Order::find($id)->order_positions]);
    }
}
