@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="w-full mx-auto px-2">
    <a href="/orders" class="btn-red" style="margin-left: 45%;">Zacznij realizację zlecenia</a>
</div>
@endsection


