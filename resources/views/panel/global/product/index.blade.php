@extends('layouts.panel')

@section('content')
<div class="container mx-auto">
    <form action="/product/search" method="post" class="w-full max-w-lg">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="search">
              Nazwa
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name='search' id="search" type="text" placeholder="Name">
          </div>
          <button type="submit" class="btn-blue">Szukaj</button>
      </form>
</div>
@endsection
