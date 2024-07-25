<!DOCTYPE html>
<html>
<head>
    <title>Un nuovo ordine è stato ricevuto</title>
</head>
<body>
    <h1>Un nuovo ordine è stato ricevuto</h1>
    <h4>Informazioni dell'ordine:</h4>
    <ul>
        <li>Nome Cliente: {{ $order->customer_name }}</li>
        <li>Indirizzo: {{ $order->customer_address }}</li>
        <li>Email: {{ $order->customer_email }}</li>
        <li>Telefono: {{ $order->customer_phone }}</li>
    </ul>

    <h4>Dettagli Ordine:</h4>
    @if($order->details)
        <p>{{$order->details}}</p>
    @else
        <p>Nessun dettaglio.</p>
    @endif

    <h4>Piatti ordinati:</h4>
    <ul>
        @foreach ($order->dishes as $dish)
            <li>{{ $dish->name }} x{{ $dish->pivot->qty }} - €{{$dish->price}}</li>
        @endforeach
    </ul>
    <h5>Totale: {{ $order->total }} €</h5>
</body>
</html>