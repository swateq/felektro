@extends('layouts.panel')

@section('title')
    Informacje o komplecie
@endsection

@section('content')
<div class="container w-full mx-auto px-2">
    <a href="/" class="btn-yellow">Wstecz</a>
    <ul class="my-10">
        @foreach ($komplet as $product)
            <li class="my-4"> <a href="/product/{{ $product->tw_Id }}"> {{ $product->tw_Nazwa   }}</a> - {{ round($product->kpl_Liczba) }} szt.</li>
        @endforeach
    </ul>
</div>
@endsection
