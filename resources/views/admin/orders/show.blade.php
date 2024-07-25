@extends('layouts.app')

@section('title', 'Dettagli Ordine')

@section('content')
<section class="my-3 py-1">
    <div class="container container-transparent p-4 rounded-3 shadow">
       
                <h3 class="text-light">Dettagli Ordine</h3>
                <table class="table  my-table-md-query scroll-table">
                    <thead>
                        <tr>
                            <th scope="col">Nome Cliente</th>
                            <th class="text-start" scope="col">Indirizzo</th>
                            <th class="text-start" scope="col">Email</th>
                            <th class="text-start" scope="col">Telefono</th>
                            <th class="text-center" scope="col">Totale Ordine</th>
                            <th class="text-center" scope="col">Data Ordine</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-start fw-lighter">{{ $order->customer_name }}</td>
                            <td class="text-start fw-lighter">{{ $order->customer_address }}</td>
                            <td class="text-start fw-lighter">{{ $order->customer_email ?? 'nessuna mail'}}</td>
                            <td class="text-start fw-lighter">{{ $order->customer_phone }}</td>
                            <td class="text-center fw-lighter">{{ $order->total }} €</td>
                            <td class="text-center fw-lighter">{{ formatItalianDate($order->created_at) }}</td>
                        </tr>
                    </tbody>
                </table>
                <h4 class="text-light mt-4">Piatti Ordinati</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome Piatto</th>
                            <th class="text-center" scope="col">Quantità</th>
                            <th class="text-center" scope="col">Prezzo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->dishes as $dish)
                            <tr>
                                <td class="text-start fw-lighter">{{ $dish->name }}</td>
                                <td class="text-center fw-lighter">{{ $dish->pivot->qty }}</td>
                                <td class="text-center fw-lighter">{{ $dish->price }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        
    </div>
</section>
@endsection
