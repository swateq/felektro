@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="w-full mx-auto px-2 flex justify-center">
    <a href="/orders" class="btn-red">Polska</a>
    <a href="/orders/export" class="btn-blue ml-4">Export</a>
</div>
@endsection


