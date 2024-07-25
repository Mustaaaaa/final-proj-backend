@extends('layouts.app')

@section('title', 'Home')



@section('content')

    <div class="container container-transparent p-5 rounded-3 shadow">
        <div class="container py-5">
            <div class="row row-gap-3 justify-content-around gap-2">
                <div class="col-10 col-md-6 align-self-end">
                    <img src="{{Vite::asset('resources/img/logo.png')}}" alt="">
                </div>
                <div class="col-10 col-md-4">
                    <img src="{{Vite::asset('resources/img/rider-business.png')}}" alt="">
                    <h1 class="display-5 fw-bold text-blue">
                        Benvenuto in Fooder business! 
                    </h1>
                </div>
                <ul class="col-12 mt-4 p-4 rounded-4  w-100 bg-blue">
                    <li class="text-white my-3 fs-4 fw-bold"> Puoi accedere alla lista dei tuoi ristoranti cliccando in alto sulla voce ristoranti.</li>
                    <li class="text-white my-3 fs-4 fw-bold"> Oppure accedere ai menù dei tuoi ristoranti ed aggiungere, modificare o eliminare un singolo piatto cliccando sulla voce Menù.</li>
                    <li class="text-white my-3 fs-4 fw-bold"> Puoi vedere gli ordini ricevuti alla voce Ordini.</li>
                    <li class="text-white my-3 fs-4 fw-bold"> Tieni sotto controllo l'andamento delle tue vendite cliccando su Statistiche.</li>
                </ul>
            </div>
        </div>
    </div>

@endsection