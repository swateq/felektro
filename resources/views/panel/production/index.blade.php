@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container w-full mx-auto px-2">
    <div class="mb-8">
        <a href="/" class="btn-blue">Aktualne</a>
        <a href="/?archive" class="btn-green">Archiwalne</a>
    </div>
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
           <thead>
               <tr>
                   <th data-priority="1">Zaakceptowano</th>
                   <th data-priority="2">Numer</th>
                   <th data-priority="3">Symbol</th>
                   <th data-priority="4">Nazwa towaru</th>
                   <th data-priority="5">Kontrahent</th>
                   <th data-priority="6">Status</th>
                   <th data-priority="6">Zamówiono</th>
                   <th data-priority="6">W produkcji</th>
                   <th data-priority="6">Wyprodukowano</th>
                   <th data-priority="6">Zostało</th>
                   <th data-priority="6">Akcja</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->accepted_date }}</td>
                    <td>{{ $order->subiekt_number }}</td>
                    <td>{{ $order->symbol }}</td>
                    <td>{{ $order->product_id }}</td>
                    <td>{{ $order->client }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td><a href="/willdo/{{ $order->id }}" class="btn-green">Zrobię</a></td>
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
