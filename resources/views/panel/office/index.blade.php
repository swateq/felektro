@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container w-full mx-auto px-2">
    <div class="mb-8">
        <a href="/" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">Aktualne</a>
        <a href="/?archive" class="bg-transparent bg-blue-500 hover:bg-blue-600 hover:text-white font-semibold text-white hover:text-black py-2 px-4 border hover:border-blue-500 border-transparent rounded">Archiwalne</a>
    </div>
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
           <thead>
               <tr>
                   <th data-priority="1">Numer</th>
                   <th data-priority="2">Kontrahent</th>
                   <th data-priority="3">Status</th>
                   <th data-priority="4">% zrealizowania</th>
                   <th data-priority="5">Akcja</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->subiekt_number }}</td>
                    <td>{{ $order->client }}</td>
                    <td>{{ $order->status }}</td>
                    <td>50 %</td>
                    <td>Pokaż</td>
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