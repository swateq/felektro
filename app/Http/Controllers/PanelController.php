<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

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
                return view('panel.office.index', ['orders' => Order::where('archive','1')->get()]);
            }else{
                return view('panel.office.index', ['orders' => Order::where('archive','0')->get()]);
            } 
        }

        
    }
}
