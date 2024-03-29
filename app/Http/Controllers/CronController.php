<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Order;
use App\MainOrder;
use Illuminate\Support\Facades\Log;

class CronController extends Controller
{
    public function getZKnormal()
    {
        $client = new Client();
        $body = $client->get('localhost:8001')->getBody();
        $obj = json_decode($body);

        foreach($obj as $i){
            if(MainOrder::where('dok_id',$i->dok_Id)->first() === null){
                $int = 1;
                $mainOrder = new MainOrder();
                $mainOrder->dok_id = $i->dok_Id;
                $mainOrder->date = $i->dok_DataWyst;
                $mainOrder->client = $i->kh_Symbol;
                $mainOrder->client_type = 'normal';
                $mainOrder->subiekt_number = $i->dok_NrPelny;
                $mainOrder->status = 'nie zaakceptowane';
                $mainOrder->quantity = 0;
                $mainOrder->done_quantity = '0';
                $mainOrder->archive = '0';
                $mainOrder->save();
            }

            if(Order::where('dok_id',$i->ob_Id)->first() === null){
                Log::Info("Dodaję: ". $i->ob_Id);
                $order = new Order();
                $subiekt_number = explode(" ",$i->dok_NrPelny);
                $order->subiekt_number = $subiekt_number[0].' '.$int.'/'.$subiekt_number[1];
                $order->main_order_id = $i->dok_Id;
                $order->product_type = $i->tw_Rodzaj;
                $order->dok_id = $i->ob_Id;
                $order->symbol = $i->tw_Symbol;
                $order->name = $i->tw_Nazwa;
                $order->client = $i->kh_Symbol;
                $order->client_type = 'normal';
                $order->quantity = $i->ob_Ilosc;
                $order->product_id = $i->tw_Id;


                $mainOrder = MainOrder::where('dok_id', '=', $order->main_order_id)->first();
                $mainOrder->quantity += $order->quantity;
                $mainOrder->save();
                $order->save();
                $int++;
            }
        }
        $this->getZKexport();
    }

    public function getZKexport()
    {
        $client = new Client();
        $body = $client->get('localhost:8001/export')->getBody();
        $obj = json_decode($body);

        foreach($obj as $i){
           $mainOrder = MainOrder::where('dok_id',$i->dok_Id)->first();
           $mainOrder->client_type = 'export';
           $mainOrder->save();

           $order = Order::where('dok_id',$i->ob_Id)->first();
           $order->client_type = 'export';
           $order->save();
        }
        return true;
    }
}
