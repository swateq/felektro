@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container w-full mx-auto px-2">
    <div class="mb-8">
        <a href="/" class="btn-green">Aktualne</a>
        <a href="/?archive" class="btn-blue">Archiwalne</a>
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
               @foreach ($main_orders as $main_order)
                <tr>
                    <td>{{ $main_order->subiekt_number }}</td>
                    <td>{{ $main_order->client }}</td>
                    <td>{{ $main_order->status }}</td>
                    <td>
                        @if ( $main_order->percent_done < 40 )
                            <div class="shadow w-full bg-grey-light mt-2">
                                <div class="bg-red-700 text-xs leading-none py-1 text-center text-white" style="width: {{ $main_order->percent_done }}%">{{ $main_order->percent_done }}%</div>
                            </div>
                        @elseif( $main_order->percent_done < 75 )
                            <div class="shadow w-full bg-grey-light mt-2">
                                <div class="bg-yellow-700 text-xs leading-none py-1 text-center text-white" style="width: {{ $main_order->percent_done }}%">{{ $main_order->percent_done }}%</div>
                            </div>
                        @else
                            <div class="shadow w-full bg-grey-light mt-2">
                                <div class="bg-green-700 text-xs leading-none py-1 text-center text-white" style="width: {{ $main_order->percent_done }}%">{{ $main_order->percent_done }}%</div>
                            </div>
                        @endif
                    </td>
                    <td><a href="/main_order/{{ $main_order->id }}" class="btn-green">Pokaż</a></td>
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
