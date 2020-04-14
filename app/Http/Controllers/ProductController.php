<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use function GuzzleHttp\json_decode;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('panel.global.product.search');
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
        $client = new Client();
        $body = $client->get('127.0.0.1:8001/product/'.$id)->getBody();
        $obj = json_decode($body);

        return view('panel.global.product.show', ['product' => $obj]);
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

    public function showKomplet($id)
    {
        $client = new Client();
        $komplet_body = $client->get('localhost:8001/komplet/'.$id)->getBody();
        $komplet = json_decode($komplet_body);
        $product_body = $client->get('localhost:8001/komplet/'.$id)->getBody();
        $product = json_decode($product_body);

        return view('panel.global.komplet', ['komplet' => $komplet, 'product' => $product]);
    }

    public function search(Request $request)
    {
        if(strlen($request->search) > 2)
        {
            $client = new Client();
            $body = $client->get('localhost:8001/product?search='.$request->search)->getBody();
            $result = json_decode($body);

            return view('panel.global.product.search_result', ['result' => $result]);
        }
        toast('Podaj minimalnie 3 znaki!','warning')->autoClose(5000)->position('top-end')->timerProgressBar();

        return back();
    }


}
