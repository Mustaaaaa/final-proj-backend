<!DOCTYPE html>
<html>
<head>
    <title>Il tuo ordine è stato ricevuto.</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center">
        <h1>Grazie per il tuo ordine, {{ $order->customer_name }}!</h1>
        <p>Abbiamo ricevuto il tuo ordine con i seguenti dettagli:</p>
        <ul>
            @foreach ($order->dishes as $dish)
                <li>{{ $dish->name }} x{{ $dish->pivot->qty }} - €{{$dish->price}}</li>
            @endforeach
        </ul>
        <p>Totale: {{ $order->total }} €</p>
    </div>
    

</body>