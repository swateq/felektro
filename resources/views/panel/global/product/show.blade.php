@extends('layouts.panel')

@section('title')
    Informacje o produkcie
@endsection

@section('content')
<div class="container w-full mx-auto px-2">
    <a href="/" class="btn-yellow">Wstecz</a>
    <ul class="my-10">
        <li class="my-4">Symbol: {{ $product[0]->tw_Symbol }}</li>
        <li class="my-4">Pełna nazwa: {{ $product[0]->tw_Nazwa }}</li>
        <li class="my-4">Opis: {{ $product[0]->tw_Opis }}</li>
        <li class="my-4">Stan: {{ round($product[0]->st_Stan) }}</li>
    </ul>
</div>
@endsection
