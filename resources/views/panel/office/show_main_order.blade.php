@extends('layouts.panel')

@push('css')
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

@section('title')
Zamówienie {{ $mainOrder->subiekt_number }}
dla klienta {{ $mainOrder->client }}
@if ($mainOrder->accepted == 0)
z dnia {{ $mainOrder->date }} niezaakceptowane.
@else
zaakceptowane dnia <button class="modal-open">{{ $mainOrder->accepted_date }}</button>.
@endif
@endsection

@section('content')
<div class="container w-full mx-auto px-2">
    <div class="flex justify-between mb-8">
        <div>
            <a href="/" class="btn-yellow">Wstecz</a>
        </div>
    </div>
    <div id='recipients' class="p-8 mt-6 mb-12 lg:mt-0 rounded shadow bg-white">
       <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
           <thead>
               <tr>
                   <th data-priority="1">Numer zlecenia</th>
                   <th data-priority="2">Symbol</th>
                   <th data-priority="3">Nazwa towaru</th>
                   <th data-priority="4">Status</th>
                   <th data-priority="5">Ilość do wyprodukowania</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($orders as $order)
                <tr>
                    <td><a href="/order/{{ $order->id }}">{{ $order->subiekt_number }}</a></td>
                    @if($order->product_type == 8)
                    <td>
                        <a href="/komplet/{{ $order->product_id }}"> {{ $order->symbol   }}</a>
                    </td>
                    <td>
                        <a href="/komplet/{{ $order->product_id }}">{{ $order->name }}</a>
                    </td>
                    @else
                    <td>
                        <a href="/product/{{ $order->product_id }}"> {{ $order->symbol   }}</a>
                    </td>
                    <td>
                        <a href="/product/{{ $order->product_id }}">{{ $order->name }}</a>
                    </td>
                    @endif
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->quantity }}</td>
                </tr>
               @endforeach
           </tbody>
       </table>
   </div>
   @if ($mainOrder->accepted == 0)
        <a href="/main_order/{{ $mainOrder->id }}/accept" class="btn-green">Zaakceptuj</a>
   @endif
   @if ($mainOrder->status == "w produkcji")
        <a href="/main_order/{{ $mainOrder->id }}/redeem" class="btn-blue">Zrealizuj pomimo niewyprodukowania całości</a>
   @endif
</div>


<body class="bg-gray-200 flex items-center justify-center h-screen">
    <!--Modal-->
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

        <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
          <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
          <span class="text-sm">(Esc)</span>
        </div>

        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
          <!--Title-->
          <div class="flex justify-between items-center pb-3">
            <p class="text-2xl font-bold">Edytuj datę akceptacji</p>
            <div class="modal-close cursor-pointer z-50">
              <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
              </svg>
            </div>
          </div>

          <!--Body-->
          <form action="/main_order/{{ $mainOrder->id }}/accepted_date" method="post">
            {{csrf_field()}}
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $mainOrder->accepted_date }}" placeholder="yyyy-mm-dd hh:mm:ss" name="accepted_date" id="accepted_date">
            <!--Footer-->
            <div class="flex justify-end pt-2">
              <button class="modal-close px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Anuluj</button>
              <button action="submit" class="px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Zapisz</button>
            </div>
          </form>


        </div>
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

<script>
    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
    	event.preventDefault()
    	toggleModal()
      })
    }

    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)

    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }

    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
    	isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
    	isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
    	toggleModal()
      }
    };


    function toggleModal () {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }


  </script>
@endpush
