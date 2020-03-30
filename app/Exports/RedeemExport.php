<?php

namespace App\Exports;

use App\Order;
use App\MainOrder;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RedeemExport implements FromView
{
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function view(): View
    {
        $mainOrder = MainOrder::where('id','=',$this->id)->first();
        $ordersNew = Order::where('main_order_id','=',$mainOrder->dok_id)->where('status','nowe')->get();
        $ordersInProduction = Order::where('main_order_id','=',$mainOrder->dok_id)->where('status','w produkcji')->get();

        foreach ($ordersInProduction as $order) {
            $order->quantity_left = $order->quantity - $order->in_production_quantity - $order->done_quantity;
        }

        return view('exports.redeem',[
                'ordersNew' => $ordersNew,
                'ordersInProduction' => $ordersInProduction
        ]);
    }
}
