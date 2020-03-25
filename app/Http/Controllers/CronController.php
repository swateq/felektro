<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Order;
use App\MainOrder;

class CronController extends Controller
{
    public function getZK()
    {
        $client = new Client();
        $body = $client->get('localhost:8001')->getBody();
        $obj = json_decode($body);

        foreach($obj as $i){
            if(MainOrder::where('dok_id',$i->dok_Id)->first() === null){
                $mainOrder = new MainOrder();
                $mainOrder->dok_id = $i->dok_Id;
                $mainOrder->client = $i->kh_Symbol;
                $mainOrder->subiekt_number = $i->dok_NrPelny;
                $mainOrder->status = 'nowe';
                $mainOrder->percent_done = '0';
                $mainOrder->archive = '0';
                $mainOrder->save();
            }

            if(Order::where('dok_id',$i->ob_Id)->first() === null){
                echo "Dodaję: ". $i->ob_Id;
                $order = new Order();
                $order->subiekt_number = $i->dok_NrPelny;
                $order->main_order_id = $i->dok_Id;
                $order->accepted_date = now();
                $order->dok_id = $i->ob_Id;
                $order->symbol = $i->tw_Symbol;
                $order->name = $i->tw_Nazwa;
                $order->client = $i->kh_Symbol;
                $order->quantity = $i->ob_Ilosc;
                $order->product_id = $i->tw_Id;
                $order->save();
            }
        }
    }
}
