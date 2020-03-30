<table>
    <thead>
    <tr>
        <th>Numer</th>
        <th>Symbol</th>
        <th>Nazwa</th>
        <th>Ilość do wyprodukowania</th>
        <th>Nie wyprodukowano</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($ordersNew as $order)
        <tr>
            <td>{{ $order->subiekt_number }}</td>
            <td>{{  $order->symbol }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->quantity }}</td>
        </tr>
       @endforeach

       @foreach ($ordersInProduction as $order)
        <tr>
            <td>{{ $order->subiekt_number }}</td>
            <td>{{  $order->symbol }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->quantity_left }}</td>
        </tr>
       @endforeach
    </tbody>
</table>
