@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('title')
Zrealizuj pomimo niewyprodukowania całości
@endsection

@section('content')
<div class="w-full mx-auto px-2">
    <div class="mb-8">
        <a href="/" class="btn-blue">Aktualne</a>
        <a href="/?archive" class="btn-green">Archiwalne</a>
    </div>
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
           <thead>
               <tr>
                   <th data-priority="1">Numer</th>
                   <th data-priority="2">Symbol</th>
                   <th data-priority="3">Nazwa</th>
                   <th data-priority="4">Ilość do wyprodukowania</th>
                   <th data-priority="5">Nie wyprodukowano</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($ordersNew as $order)
                <tr>
                    <td>{{ $order->subiekt_number }}</td>
                    <td>
                        @if ( $order->product_type == 8 )
                            <div class="flex">
                                <img class="mr-2" src="/img/box.png" width="20px" height="20px"><a href='/komplet/{{ $order->product_id }}'> {{  $order->symbol }}</a>
                            </div>
                        @else
                            <a href='/product/{{ $order->product_id }}'>{{  $order->symbol }}</a>
                        @endif
                    </td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->quantity }}</td>
                </tr>
               @endforeach

               @foreach ($ordersInProduction as $order)
                <tr>
                    <td>{{ $order->subiekt_number }}</td>
                    <td>
                        @if ( $order->product_type == 8 )
                            <div class="flex">
                                <img class="mr-2" src="/img/box.png" width="20px" height="20px"><a href='/komplet/{{ $order->product_id }}'> {{  $order->symbol }}</a>
                            </div>
                        @else
                            <a href='/product/{{ $order->product_id }}'>{{  $order->symbol }}</a>
                        @endif
                    </td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->quantity_left }}</td>
                </tr>
               @endforeach
           </tbody>
       </table>
   </div>
   <a href="#" class="btn-blue">Zrealizuj</a>
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
