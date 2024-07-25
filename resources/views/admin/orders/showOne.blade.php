@extends('layouts.app')

@section('title', 'Ordini per ' . $company->name)

@section('content')
    <section class="my-3 py-1">
        <div class="container container-transparent p-4 rounded-3 shadow">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-end mt-5 mb-1">
                        <h3 class="text-light">
                            <p class="text-blue fs-2 bg-light rounded-3 p-2 shadow">
                                {{ $company->name }}
                                <span class="fs-6 ms-3">{{ $company->address }}</span>
                            </p>
                        </h3>
                    </div>
                    <table class="table my-table-md-query scroll-table">
                        <thead>
                            <tr>
                                <th scope="col">Nome Cliente</th>
                                <th class="text-start" scope="col">Indirizzo</th>
                                <th class="text-start" scope="col">Telefono</th>
                                <th class="text-center" scope="col">Totale Ordine</th>
                                <th class="text-center" scope="col">Data Ordine</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="order-tbody">
                            @forelse ($orders as $order)
                            <tr class="position-relative">
                                <td class="text-start fw-lighter">{{ $order->customer_name }}</td>
                                <td class="text-start fw-lighter">{{ $order->customer_address }}</td>
                                <td class="text-start fw-lighter">{{ $order->customer_phone }}</td>
                                <td class="text-center fw-lighter">{{ $order->total }} €</td>
                                <td class="text-center fw-lighter">{{ formatItalianDate($order->created_at) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                        class="link link-success"><i class="fa-regular fa-eye"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center fw-lighter">Nessun ordine per questa compagnia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Pulsante per caricare ulteriori 10 risultati -->
                    @if ($orders->count() > 0)
                        <div class="d-flex justify-content-center">
                            <button id="loadMore" class="btn btn-link text-decoration-none text-blue">Carica Altri</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Script per gestire il caricamento aggiuntivo -->
    <script>

        function formatItalianDate(dateString) {
            const date = new Date(dateString);
            
            const day = ("0" + date.getDate()).slice(-2); // Ottiene il giorno con due cifre (dd)
            const month = ("0" + (date.getMonth() + 1)).slice(-2); // Ottiene il mese con due cifre (mm)
            const year = date.getFullYear(); // Ottiene l'anno (aaaa)
            
            const hours = ("0" + date.getHours()).slice(-2); // Ottiene l'ora con due cifre (hh)
            const minutes = ("0" + date.getMinutes()).slice(-2); // Ottiene i minuti con due cifre (mm)
            
            return `${day}-${month}-${year} alle ${hours}:${minutes}`;
        }



        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreBtn = document.getElementById('loadMore');
            let currentCount = {{ $orders->count() }};
            let perPage = 10;

            loadMoreBtn.addEventListener('click', function() {
                // Effettua la richiesta AJAX per caricare ulteriori risultati
                fetchMoreResults();
            });

            function fetchMoreResults() {
                fetch("{{ route('admin.orders.fetchMore', $company->id) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        perPage: perPage,
                        currentCount: currentCount
                    })
                })
                .then(response => response.json())
                .then(data => {
                    appendOrders(data.orders);
                    currentCount += data.orders.length;
                    if (data.orders.length < perPage) {
                        loadMoreBtn.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Errore nel caricamento degli ordini:', error);
                });
            }

            function appendOrders(orders) {
                const tbody = document.querySelector('#order-tbody');
                let html = '';
                orders.forEach(order => {
                    const formattedDate = formatItalianDate(order.created_at);

                    html += `
                        <tr class="position-relative">
                            <td class="text-start fw-lighter">${order.customer_name}</td>
                            <td class="text-start fw-lighter">${order.customer_address}</td>
                            <td class="text-start fw-lighter">${order.customer_phone}</td>
                            <td class="text-center fw-lighter">${order.total} €</td>
                            <td class="text-center fw-lighter">${formattedDate}</td>
                            <td class="text-center">
                                @if(isSet($order))                                
                                    <a href="{{ route('admin.orders.show', $order) }}" class="link link-success"><i class="fa-regular fa-eye"></i></a>
                                @endif
                            </td>
                        </tr>
                    `;
                });
                tbody.innerHTML += html;
            }
        });
    </script>
@endsection
