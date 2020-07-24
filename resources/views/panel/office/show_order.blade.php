@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container w-full mx-auto px-2">
    <div class="mb-8">
        <a href="{{ url()->previous() }}" class="btn-yellow">Wstecz</a>
    </div>
    </div>
    @if (count($orderPositions) > 0)
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
                @foreach ($orderPositions as $orderPosition)
                 <tr>
                     <td>{{ ucfirst($orderPosition->worker) }}</td>
                     <td>{{ $orderPosition->status }}</td>
                     <td>{{ $orderPosition->quantity }}</td>
                 </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        Nikt aktualnie nie realizuje tego zlecenia
    @endif
        <a href="http://192.168.50.50:8001/addpw/{{ $order->product_id }}/{{ $order->quantity }}" class="btn-green">Wywołaj PW</a>
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
