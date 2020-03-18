@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container w-full mx-auto px-2">
    <div class="flex justify-between mb-8">
        <div>

        </div>
        <div>
            <a href="/" class="btn-yellow">Wstecz</a>
        </div>
    </div>
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
       <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
           <thead>
               <tr>
                   <th data-priority="1">Pracownik</th>
                   <th data-priority="2">Status</th>
                   <th data-priority="3">Ilośc do wyprodukowania</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($order as $orderPosition)
                <tr>
                    <td>{{ $orderPosition->worker }}</td>
                    <td>{{ $orderPosition->status }}</td>
                    <td>{{ $orderPosition->quantity }}</td>
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
