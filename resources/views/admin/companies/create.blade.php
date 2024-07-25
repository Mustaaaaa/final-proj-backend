@extends('layouts.app')
@section('title', 'Crea un nuovo ristorante')

@section('content')
<div class="container bg-light mt-5 mb-5 rounded-4 p-5 text-blue shadow">
    <h1>Crea il tuo ristorante</h1>
    <form action="{{ route('admin.companies.store')}}" method="POST" class="my-company-form" enctype="multipart/form-data">
        @csrf
        
        <div>
            <p class="text-danger">* campi obbligatori</p>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label fb-bold">Nome *</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Inserisci il nome" value="{{ old('name') }}" maxlength="250">
        </div>
        <div class="mb-3">
         <label for="city" class="form-label fb-bold">Città *</label>
         <input type="text" class="form-control" name="city" id="city" placeholder="Inserisci la città" value="{{ old('city') }}" maxlength="250">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label fb-bold">Indirizzo *</label>
            <input type="text" class="form-control" name="address" id="address" placeholder="Inserisci la via" value="{{ old('address') }}" maxlength="250">
        </div>
        <div class="mb-3">
            <label for="vat_number" class="form-label fb-bold">P.iva *</label>
            <input type="text" class="form-control" name="vat_number" id="vat_number" placeholder="Inserisci la p.iva" value="{{ old('vat_number') }}" minlength="11" maxlength="11">
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label fb-bold">Telefono *</label>
            <input type="tel"  class="form-control" name="phone_number" id="phone_number" placeholder="Inserisci il numero di telefono" value="{{ old('phone_number') }}" maxlength="50">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label fb-bold">Email *</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Inserisci la tua email" value="{{ old('email') }}" maxlength="255">
            <div>
                <p id="error-mail" class="text-danger"></p>
            </div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
           <textarea class="form-control" name="description" id="description" placeholder="Inserisci la descrizione" maxlength="2000">{{ old('description') }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="type_id"class="mb-2">Tipologia *</label>
            <div class="mb-3 d-flex flex-wrap justify-content-around w-100 p-3">
                @foreach ($types as $type)
                    <div class="form-check">
                        <input @checked(in_array($type->id, old('types', []))) type="checkbox" id="type-{{ $type->id }}"
                            value="{{ $type->id }}" name="types[]" class="form-check-input checkbox">
                        <label class="form-check-label" for="type-{{ $type->id }}">{{ $type->name }}</label>
                    </div>
                    @endforeach
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label fb-bold">Carica un'immagine</label>
                    <input class="form-control text-blue" type="file" name="image" id="image" accept=".jpg, .jpeg, .png, .bmp, .svg, .webp">
                </div>
                <div>
                    <p id="error-text" class="text-danger"></p>
                </div>
                <button class="btn btn-primary">Crea</button>
                
            </form>
            <p id="selectedOptions"></p>
</div>
<div class="container mt-4">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

@endsection