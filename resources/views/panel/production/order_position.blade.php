@extends('layouts.panel')

@section('title')
Zrobię {{ $order->subiekt_number }}
@endsection

@section('content')
<div class="container w-full mx-auto px-2">
<form action="/order_position" method="post">
    @csrf
    <div class="flex flex-wrap mt-16">
        <input value="{{ $order->id }}" type="number" name="order_id" id="order_id" hidden>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Kto
            </label>
            <div class="relative">
                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="worker" name="worker">
                    <option value="krzysiek">Krzysiek</option>
                    <option value="piotrek">Piotrek</option>
                    <option value="adam">Adam</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
            Ile
            </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="quantity" name="quantity" type="number" value="{{ $order->quantity - $order->done_quantity - $order->in_production_quantity }}" min="1" max="{{ $order->quantity - $order->done_quantity - $order->in_production_quantity }}">
        </div>

        <button type="submit" class="btn-green">Zapisz</button>
    </div>
</form>

</div>
@endsection
