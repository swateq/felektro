<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Order;

class CronController extends Controller
{
    public function getZK()
    {
        $client = new Client();
        $body = $client->get('localhost:8000')->getBody();
        $obj = json_decode($body);

        foreach($obj as $i){
            if(Order::where('dok_id',$i->ob_Id)->first() === null){
                echo "Dodaję: ". $i->ob_Id;
                $order = new Order();
                $order->subiekt_number = $i->dok_NrPelny;
                $order->accepted_date = now();
                $order->dok_id = $i->ob_Id;
                $order->symbol = $i->tw_Nazwa;
                $order->client = $i->kh_Symbol;
                $order->quantity = $i->ob_Ilosc;
                $order->product_id = $i->tw_Id;
                $order->save();
            }
        }
    }
}
