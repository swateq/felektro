@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container w-full mx-auto px-2">
    <div class="flex justify-between mb-8">
        <div>
            <h4>Zamówienie: {{ $orders[0]->main_order->subiekt_number }}</h4>
            <h4>Klient: {{ $orders[0]->main_order->client }}</h4>
        </div>
        <div>
            <a href="/" class="btn-yellow">Wstecz</a>
        </div>
    </div>
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
           <thead>
               <tr>
                   <th data-priority="1">Numer zlecenia</th>
                   <th data-priority="2">Symbol</th>
                   <th data-priority="3">Nazwa towaru</th>
                   <th data-priority="4">Ilośc do wyprodukowania</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($orders as $order)
                <tr>
                    <td><a href="/order/{{ $order->id }}">{{ $order->subiekt_number }}</a></td>
                    <td>{{ $order->symbol }}</td>
                    <td>{{ $order->product_id }}</td>
                    <td>{{ $order->quantity }}</td>
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
