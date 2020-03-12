<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class PanelController extends Controller
{
    public function index(){
        if(request()->has('archive')){
            return view('panel.index', ['orders' => Order::where('archive','1')->get()]);
        }else{
            return view('panel.index', ['orders' => Order::where('archive','0')->get()]);
        }
    }
}
