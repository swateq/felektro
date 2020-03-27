@extends('layouts.panel')

@section('content')
<div class="container mx-auto">
    <form action="/admin/workers" method="post" class="w-full max-w-lg">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
              Nazwa
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name='name' id="name" type="text" placeholder="Name">
          </div>
          <button type="submit" class="btn-blue">Dodaj</button>
      </form>
</div>
@endsection
