@extends('layouts.app')

@section('title', 'I Tuoi Ordini')

@section('content')
@php
    $companies_dict = $companies->keyBy('name');
@endphp

<section class="my-3 py-1">
    <div class="container container-transparent p-4 rounded-4">
       
            <h2 class="text-blue text-center fs-2 bg-light rounded-3 p-2 mx-3 shadow mt-3">
                Tutti i Tuoi Ordini
            </h2>
            <div class="container">
                @foreach ($companies as $company)
                    @php
                        $ordersGroups = $companyOrders[$company->name] ?? collect();
                        $currentChunkIndex = request()->input('chunk' . $company->id, 0);
                        $currentOrders = $ordersGroups[$currentChunkIndex] ?? collect();
                    @endphp
                <div id="company-{{ $company->id }}" class="title text-blue bg-light rounded-3 p-2 shadow my-3">
                    <div class=" d-flex flex-column mt-5 mb-1 text-break">
                        <h3> {{ $company->name }}</h3>
                        <p>  {{ $company->address }}  </p>
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
                        <tbody>
                            @if ($currentOrders->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">Nessun ordine per questa compagnia.</td>
                                </tr>
                            @else
                                @foreach ($currentOrders as $order)
                                    <tr class="position-relative">
                                        <td class="text-start fw-lighter">{{ $order->customer_name }}</td>
                                        <td class="text-start fw-lighter">{{ $order->customer_address }}</td>
                                        <td class="text-start fw-lighter">{{ $order->customer_phone}}</td>
                                        <td class="text-center fw-lighter">{{ $order->total}} €</td>
                                        <td class="text-center fw-lighter">{{ formatItalianDate($order->created_at) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="link link-success"><i class="fa-regular fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                    @if($ordersGroups->count() > 0)
                        <div class="d-flex justify-content-between">
                            @if ($currentChunkIndex > 0)
                                <a href="{{ request()->fullUrlWithQuery(['chunk' . $company->id => $currentChunkIndex - 1]) }}#company-{{ $company->id }}" class="btn btn-link bg-light text-decoration-none shadow p-2 rounded-3 text-blue">Indietro</a>
                            @else
                                <span></span>
                            @endif

                            @if ($currentChunkIndex < $ordersGroups->count() - 1)
                                <a href="{{ request()->fullUrlWithQuery(['chunk' . $company->id => $currentChunkIndex + 1]) }}#company-{{ $company->id }}" class="btn btn-link bg-light text-decoration-none p-2 shadow rounded-3 text-blue">Avanti</a>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        
    </div>
</section>
@endsection
