@extends('layouts.app')

@section('title', $company->name)



@section('content')
<section class="my-3 py-1">
    <div class="container p-4 rounded-4">
        <div class="row justify-content-center">
            <div class="col col-md-10 col-lg-8">
                <div class="card shadow p-3 rounded-3">
                    @if($company->image)
                        <img src="{{ asset('storage/' . $company->image) }}" alt="nessuna immagine" class="card-img-top rounded-3 mb-3">
                    @else
                    <img src="{{  asset('storage/image/default-company.png') }} " class="card-img-top" alt="...">      
                    @endif
                    <div class="px-3">
                        <p class="fs-3 text-blue">{{$company->name}}</p>
                        <p class="fs-5 text-blue">{{$company->description}}</p>
                    </div>
                    
                    <table class="table my-table-xs-query scroll-table">
                        <tbody>
                            <tr class="border-top">
                                <td class="border-end"><strong>Città:</strong></td>
                                <td>{{$company->city}}</td>
                            </tr>
                            <tr>
                                <td class="border-end"><strong>Indirizzo:</strong></td>
                                <td>{{$company->address}}</td>
                            </tr>
                            <tr>
                                <td class="border-end"><strong>P.iva:</strong></td>
                                <td>{{$company->vat_number}}</td>
                            </tr>
                            <tr>
                                <td class="border-end"><strong>Tipo:</strong></td>
                                <td>
                                    @foreach($company->types as $type)
                                        {{$type->name}}
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="border-end"><strong>Telefono:</strong></td>
                                <td>{{$company->phone_number}}</td>
                            </tr>
                            <tr>
                                <td class="border-end"><strong>Email:</strong></td>
                                <td>{{$company->email}}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="card-body d-flex justify-content-around position-relative">
                        <a href="{{ route('admin.companies.edit', $company)}}" class="link link-primary fs-4"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form class="item-delete-form" action="{{ route('admin.companies.destroy', $company) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link p-0 m-0 no-style fs-4 text-danger"><i class="fas fa-trash-alt "></i></button>
                            <div class="my-modal">
                                <div class="my-modal__box flex-column">
                                    <h4 class="text-center">Vuoi eliminare questo Ristorante?</h4>
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
</section>
@endsection