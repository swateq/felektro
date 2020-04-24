@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('title')
    Informacje o komplecie
@endsection

@section('content')
<div class="container w-full mx-auto px-2">
    <div class="mb-8">
        Symbol: {{ $product[0]->tw_Symbol }}<br/>
        Nazwa: {{ $product[0]->tw_Nazwa }}<br/>
        <div class="flex my-2">
            <a target="_blank" href="https://f-elektro.com/!data/attachments/{{ $product[0]->tw_Symbol }}_technical1.pdf">
                Rysunek techniczny<img src="/img/pdf.png" alt="">
            </a>
            <a class="ml-4" target="_blank" href="https://f-elektro.com/!data/attachments/{{ $product[0]->tw_Symbol }}_card1.pdf">
                Karta katalogowa<img src="/img/pdf.png" alt="">
            </a>
            <a target="_blank" href="https://f-elektro.com/!data/products/b_{{ $product[0]->tw_Symbol }}_photo1.jpg">
                <img src="https://f-elektro.com/!data/products/s_{{ $product[0]->tw_Symbol }}_photo1.jpg" alt="">
            </a>
        </div>
    </div>

    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
           <thead>
               <tr>
                   <th data-priority="1">Symbol</th>
                   <th data-priority="2">Nazwa</th>
                   <th data-priority="3">Ilość</th>
                   <th data-priority="4">Jednostka miary</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($komplet as $product)
                <tr>
                    <td><a href="/product/{{ $product->tw_Id }}">{{ $product->tw_Symbol }}</a></td>
                    <td>{{ $product->tw_Nazwa }}</td>
                    <td>
                        @if ($product->kpl_Liczba >= 1)
                            {{ round($product->kpl_Liczba) }}
                        @else
                            {{ $product->kpl_Liczba }}
                        @endif
                    </td>
                    <td>{{ $product->tw_JednMiary }}</td>
                </tr>
               @endforeach
           </tbody>
       </table>
   </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


<script>
    $(document).ready(function() {

        var table = $('#example').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Polish.json"
                }
            } )
            .columns.adjust()
            .responsive.recalc();
    } );
</script>
@endpush
