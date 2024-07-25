@extends('layouts.app')
@section('title', 'Dashboard')


@section('content')
<div class="container">
    <h2 class="fs-2 fw-bold text-white my-4">    
        Benvenuto {{$user_name}}
    </h2>

    <div class="row justify-content-center">
        <div class="col">
            <div class="container-transparent d-flex flex-column justify-content-between rounded-4 p-4">
                <div class="card-header "> 
                    <h4 class="text-blue fs-2 bg-light rounded-3 p-2 shadow">
                        Lista Ristoranti 
                    </h4>
                </div>

                <div class="card-body container px-3">
                    <div class="row py-5 gap-4 row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">                    
                        @forelse ($companies as $company)
                            <div class="col d-flex card-group justify-content-center">
                                <div class="bg-light shadow d-flex flex-column justify-content-between p-3 rounded-3 w-100">
                                    <div class="card-header" style="height:200px">
                                        @if($company->image)
                                        <img src="{{ asset('storage/' . $company->image) }}" alt="nessuna immagine" class="card-img-top h-100 object-fit-cover rounded-3">
                                        @else
                                        <img src="{{  asset('storage/image/default-company.png') }} " class="card-img-top h-100 object-fit-cover rounded-3" alt="...">      
                                        @endif
                                    </div>
                                    <div class="card-body text-blue position-relative">
                                        <p class="card-title fs-3 fw-bold text-break">
                                            <a href="{{route('admin.dishes.showOne', $company->id)}}">
                                                {{$company->name}}
                                            </a>
                                        </p>
                                        <p class="card-title fs-5 fw-bold text-break">
                                            {{$company->address}}
                                        </p>
                                    </div>
                                    <p class="text-end me-3"> <i class="fa-solid fa-utensils me-1"></i><span> {{count($company->dishes)}} </span></p>
                                    @if(count($company->dishes) === 0)
                                        <small class="text-end me-3"><a class="text-danger" href="{{route('admin.dishes.create', ['company_id' => $company->id])}}">Aggiungi almeno un piatto.</a></small>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <h4 class="py-2 bg-light rounded-3 text-danger text-center">Non hai ancora alcun ristorante. <a class="text-warning" href="{{route('admin.companies.create')}}">Creane uno!</a> </>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
