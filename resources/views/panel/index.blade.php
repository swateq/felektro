@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container w-full mx-auto px-2">
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
               <tr>
                   <td>2019-10-24 10:59</td>
                   <td>ZK 1/1566/mag/10/2019</td>
                   <td>F3.0052</td>
                   <td>nazwa z subiekta</td>
                   <td>PORTO</td>
                   <td>w produkcji</td>
                   <td>7</td>
                   <td>2</td>
                   <td>5</td>
                   <td>0</td>
                   <td>Zrobię</td>
               </tr>
               <tr>
                   <td>2019-10-27 15:59</td>
                   <td>ZK 2/1566/mag/10/2019</td>
                   <td>F5.5785</td>
                   <td>nazwa z subiekta</td>
                   <td>el-corte</td>
                   <td>nowe</td>
                   <td>10</td>
                   <td>0</td>
                   <td>0</td>
                   <td>10</td>
                   <td>Zrobię</td>
               </tr>
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