@extends('layouts.app')

@section('title', 'I Tuoi Ristoranti')


@section('content')

<section class="container container-transparent p-4 rounded-4">
    <div class="container mt-3 mb-3 p-3 d-flex justify-content-between">
        @unless (request('trash'))

            <a class="btn btn-blue d-flex text-decoration-none justify-content-center align-items-center" href="{{ route('admin.companies.create')}}">Crea il tuo ristorante</a>
        @endunless
        @if (request('trash'))
            <div  class="d-flex flex-column align-items-center justify-content-center">
                <button class="btn btn-danger">
                    <a href="{{ route('admin.companies.index')}}" class="btn link-light p-0 m-0 no-style align-content-center">Indietro</a>
                </button>
            </div>
        @else
            <button class="btn btn-danger">
            
                <a href="{{ route('admin.companies.index', ['trash' => 1])}}" class="-link-color-white text-decoration-none">
                Vai al tuo cestino <i class="fas fa-trash-alt "></i></a>
            </button>

        @endif
    </div>
    <div class="container">
        <table class="table my-table-sm-query scroll-table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th class="text-center" scope="col">Indirizzo</th>
                    {{-- <th class="text-center" scope="col">Numero di telefono </th> --}}
                    {{-- <th class="text-center" scope="col">Email</th> --}}
                    @if (request('trash'))
                    @else
                        <th class="text-center"></th>
                    @endif
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($companies as $company)
                    <tr class="position-relative">
                        <td>
                            <a href="{{ route('admin.dishes.showOne', $company->id) }}">{{ $company->name }}</a>
                        </td>
                        <td class="text-center">{{ $company->address}}, {{ $company->city }}</td>
                        {{-- <td class="text-center">{{ $company->phone_number}}</td> --}}
                        {{-- <td class="text-center">{{ $company->email}}</td> --}}



                        @unless($company->trashed())
                            <td class="text-center">
                                <a href="{{ route('admin.companies.show', $company)}}" class="link link-success"><i class="fa-regular fa-eye"></i></a>
                            </td>
                            <td class="text-center"><a href="{{ route('admin.companies.edit', $company)}}"
                                    class="link link-primary"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        @elseif ($company->trashed())
                            <td class="text-center">
                                <form action="{{ route('admin.companies.restore', $company->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn link-warning p-0 m-0 no-style">Ripristina</button>
                                </form>
                            </td>
                        @endunless

                        <td class="text-center">
                            @unless($company->trashed())
                                <form class="item-delete-form"
                                    action="{{ $company->trashed() ? route('admin.companies.forceDestroy', $company) : route('admin.companies.destroy', $company) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link p-0 m-0 no-style text-danger"><i
                                            class="fas fa-trash-alt "></i></button>
                                    <div class="my-modal">
                                        <div class="my-modal__box">
                                            <h4 class="text-center me-3">Vuoi eliminare questo Ristorante?</h4>
                                            
                                                <span class="link link-danger my-modal-yes mx-2">Si</span>
                                                <span class="link link-success my-modal-no mx-2">No</span>
                                                    
                                        </div>
                                    </div>
                                </form>
                            @endunless
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</section>
@endsection