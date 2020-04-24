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
        <li class="my-4 flex">
            <a target="_blank" href="https://f-elektro.com/!data/attachments/{{ $product[0]->tw_Symbol }}_technical1.pdf">
                Rysunek techniczny<img src="/img/pdf.png" alt="">
            </a>
            <a class="ml-4" target="_blank" href="https://f-elektro.com/!data/attachments/{{ $product[0]->tw_Symbol }}_card1.pdf">
                Karta katalogowa<img src="/img/pdf.png" alt="">
            </a>
        </li>
        <li>
            <a target="_blank" href="https://f-elektro.com/!data/products/b_{{ $product[0]->tw_Symbol }}_photo1.jpg">
                <img src="https://f-elektro.com/!data/products/s_{{ $product[0]->tw_Symbol }}_photo1.jpg" alt="">
            </a>
        </li>
    </ul>
</div>

@endsection
