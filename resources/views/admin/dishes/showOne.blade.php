@extends('layouts.app')

@section('title', $company->name)

<?php
    $slug = $company->slug;
    $frontendUrl = 'http://localhost';
    $frontendPort = env('APP_FRONTEND_PORT');
    $url = "{$frontendUrl}:{$frontendPort}/menu/{$slug}";
?>

@section('content')


<section class="container mt-5 mb-5 container-transparent rounded-4 p-4">
    <h2 class="mb-3 text-center ">
        <a class="text-decoration-none btn btn-blue" href="<?php  echo htmlspecialchars($url); ?>">
            Vai al tuo Menu su Fooder
        </a>
    </h2>
    <div class="container my-5">
        <div class="row g-0 justify-content-between align-items-center mt-5">
            <div class="col-auto col-md-12 text-blue bg-light rounded-3 p-2 shadow mb-3">
                <h1 class="text-break">
                    {{$company->name}}
                </h1>
            </div>
            @unless (request('trash'))
                <a class=" col-2 col-md-2 col-lg-1 btn btn-blue fs-2 text-decoration-none d-flex justify-content-center align-items-center my-1 p-3"
                    href="{{ route('admin.dishes.create', ['company_id' => $company->id])}}"><i class="fas fa-plus"></i>
                </a>
                <button class="btn btn-danger col-5 col-md-4 col-lg-3">
                    <a href="{{ route('admin.dishes.showOne', ['dish' => $company->id, 'trash' => 1])}}" class="-link-color-white text-decoration-none"> Vai al tuo cestino  <i class="fas fa-trash-alt "></i></a>
                    </a>
                </button>
            @elseif (request('trash'))
                <div  class="d-flex flex-column align-items-center justify-content-center">
                <h3 class="text-center text-blue mt-3">Il tuo Cestino</h3>
                <button class="btn btn-danger">

                    <a href="{{route('admin.dishes.showOne', ['dish' => $company->id])}}" class="-link-color-white">Indietro</a>
                                
                </button>
                </div>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table my-table-sm-query scroll-table">
                    <thead>
                        <tr>
                            <th scope="col">Nome piatto</th>
                            <th class="text-center" scope="col">Prezzo</th>
                            <th class="text-center" scope="col">Disponibile</th>
                            @if(request('trash'))
                                <th></th>
                                <th></th>
                            @endif
                            @unless(request('trash'))
                                <th class="text-center" scope="col">Visualizza</th>
                                <th class="text-center" scope="col">Modifica</th>
                                <th class="text-center" scope="col">Elimina</th>
                            @endunless
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dishes as $dish)
                            <tr class="position-relative">
                                <td>{{ $dish->name }}</td>
                                <td class="text-center">{{ $dish->price}} €</td>
                                <td class="text-center">{{ $dish->visible === 1 ? 'Sì' : 'No'}}</td>
                                @unless($dish->trashed())
                                    <td class="text-center">
                                        <a href="{{ route('admin.dishes.show', $dish) }}" class="link link-success"><i class="fa-regular fa-eye"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.dishes.edit', $dish) }}" class="link link-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                @elseif ($dish->trashed())
                                    <td class="text-center">
                                        <form action="{{ route('admin.dishes.restore', $dish->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn link-warning p-0 m-0 no-style">Ripristina</button>
                                        </form>
                                    </td>
                                @endunless
                                <td class="text-center">
                                    @if(!$dish->trashed())
                                        <form class="item-delete-form"
                                            action="{{$dish->trashed() ? route('admin.dishes.forceDestroy', $dish) : route('admin.dishes.destroy', $dish) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-link p-0 m-0 no-style text-danger"><i class="fas fa-trash-alt "></i></button>
                                            <div class="my-modal">
                                                <div class="my-modal__box">
                                                    <h4 class="text-center me-3">Vuoi eliminare questo Piatto?</h4>
                                                    <span class="link link-danger my-modal-yes mx-2">Si</span>
                                                    <span class="link link-success my-modal-no mx-2">No</span>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection