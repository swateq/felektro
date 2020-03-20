@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<a href="/" class="btn-yellow">Wstecz</a>
<div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
    <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
        <thead>
            <tr>
                <th data-priority="1">Kto</th>
                <th data-priority="2">Ile sztuk</th>
                <th data-priority="3">Status</th>
                <th data-priority="4">Akcja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order_positions as $order_positions)
             <tr>
                <td>{{ $order_positions->worker }}</td>
                <td>{{ $order_positions->quantity }}</td>
                <td>{{ $order_positions->status }}</td>
                <td>
                    @if ($order_positions->status != "zrobione")
                        <form action="/order_position/done/{{ $order_positions->id }}" method="post">
                            @csrf
                            <button type="submit" class="btn-green">Zrobione</button>
                        </form>
                    @endif
                </td>
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
                    "responsive": true,
                    "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Polish.json"
                }
            } )
            .columns.adjust()
            .responsive.recalc();
    } );
</script>
@endpush
