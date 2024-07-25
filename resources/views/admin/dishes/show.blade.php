@extends('layouts.app')

@section('title', $dish->name)

@section('content')
<section class="my-5 py-1">
    <div class="container-transparent container py-4 px-2 m-auto rounded-3 shadow">
    <h1 class="text-center text-light my-4 pb-4 text-break">{{$dish->company->name}}</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="card shadow p-3">
                    @if($dish->image)
                    <img src="{{  asset('storage/'. $dish->image) }} " class="card-img-top my-card-img" alt="...">
                    @else
                    <img src="{{  asset('storage/image/default-image.png') }} " class="card-img-top my-card-img" alt="...">      
                    @endif
                    <div class="card-body">
                        <h4 class="card-title">{{ $dish->name }}</h4>
                        <p class="card-text">{{ $dish->description ? $dish->description : 'Nessuna Descrizione.'  }}</p>
                    </div>

                    <table class="table my-table-xs-query scroll-table">
                        <thead>
                            <th scope="col" class="col-3"></th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            <tr class="border-top">
                                <td class="border-end" scope="col-2"><strong>Prezzo:</strong></td>
                                <td>{{ $dish->price }} €</td>
                            </tr>
                            <tr>
                                <td class="border-end" scope="col-2"><strong>Disponibile:</strong></td>
                                <td>{{ $dish->visible === 1 ? 'Sì' : 'No' }}</td>
                            </tr>
                            <tr >
                                <td class="border-end" scope="col-2"><strong>Ingredienti:</strong></td>
                                <td>{{ $dish->ingredients }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="card-body d-flex justify-content-around position-relative">
                        <a href="{{route('admin.dishes.edit', $dish)}}" class="link link-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form class="item-delete-form" action="{{ route('admin.dishes.destroy', $dish) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link p-0 m-0 no-style text-danger"><i class="fas fa-trash-alt "></i></button>
                            <div class="my-modal">
                                <div class="my-modal__box flex-column">
                                    <h4 class="text-center">Vuoi eliminare questo Piatto?</h4>
                                    <p>
                                        <span class="link link-danger my-modal-yes ms-2">Si</span>
                                        <span class="link link-success my-modal-no ms-2">No</span>
                                    </p> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection