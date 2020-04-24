@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('title')
Zamówienie {{ $mainOrder->subiekt_number }}
dla klienta {{ $mainOrder->client }} z {{ $mainOrder->date }}
@if ($mainOrder->accepted == 0)
niezaakceptowane.
@else
zaakceptowane.
@endif
@endsection

@section('content')
<div class="container w-full mx-auto px-2">
    <div class="flex justify-between mb-8">
        <div>
            <a href="/" class="btn-yellow">Wstecz</a>
        </div>
    </div>
    <div id='recipients' class="p-8 mt-6 mb-12 lg:mt-0 rounded shadow bg-white">
       <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
           <thead>
               <tr>
                   <th data-priority="1">Numer zlecenia</th>
                   <th data-priority="2">Symbol</th>
                   <th data-priority="3">Nazwa towaru</th>
                   <th data-priority="4">Status</th>
                   <th data-priority="5">Ilośc do wyprodukowania</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($orders as $order)
                <tr>
                    <td><a href="/order/{{ $order->id }}">{{ $order->subiekt_number }}</a></td>
                    @if($order->product_type == 8)
                    <td>
                        <a href="/komplet/{{ $order->product_id }}"> {{ $order->symbol   }}</a>
                    </td>
                    <td>
                        <a href="/komplet/{{ $order->product_id }}">{{ $order->name }}</a>
                    </td>
                    @else
                    <td>
                        <a href="/product/{{ $order->product_id }}"> {{ $order->symbol   }}</a>
                    </td>
                    <td>
                        <a href="/product/{{ $order->product_id }}">{{ $order->name }}</a>
                    </td>
                    @endif
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->quantity }}</td>
                </tr>
               @endforeach
           </tbody>
       </table>
   </div>
   @if ($mainOrder->accepted == 0)
        <a href="/main_order/{{ $mainOrder->id }}/accept" class="btn-green">Zaakceptuj</a>
   @endif
   @if ($mainOrder->status == "w produkcji")
        <a href="/main_order/{{ $mainOrder->id }}/redeem" class="btn-blue">Zrealizuj pomimo niewyprodukowania całości</a>
   @endif
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
