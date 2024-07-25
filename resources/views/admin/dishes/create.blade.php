@extends('layouts.app')

@section('content')
<div class="container bg-light mt-5 mb-5 rounded-4 p-5 text-blue shadow">
    <h1>Crea il tuo Piatto </h1>
    <form action="{{ route('admin.dishes.store')}}" method="POST" class="my-dish-form" enctype="multipart/form-data">
        @csrf


        <!-- Nome Piatto -->
        <div class="mb-3">
            <label for="name" class="form-label fb-bold">Nome *</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Inserisci il nome"
                value="{{ old('name') }}" maxlength="250">
        </div>


        <!-- Prezzo Piatto -->
        <div class="mb-3">
            <label for="price" class="form-label fb-bold">Prezzo( € ) *</label>
            <input type="number" class="form-control" name="price" id="price" min="0" max="9999" step=".01"
                placeholder="Inserisci il Prezzo (Es 10.00)" value="{{ old('price') }}">
        </div>


        <!-- Visibilità Piatto -->
        <div class="mb-3">
            <label for="visible" class="form-label fb-bold">Disponibilità nel Menù *</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="dish-visibility"
                    name="visible" @if(old('visible', $dish->visible ?? false)) checked @endif value="1">

                </div>
                <p id="ciao">Piatto non disponibile</p>
        </div>


        <!-- Ingredienti Piatto -->
        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredienti *</label>
            <textarea class="form-control" name="ingredients" id="ingredients" placeholder="Inserisci gli ingredienti"
                data-required="true" maxlength="2000">{{ old('ingredients') }}</textarea>
        </div>


        <!-- Descrizione Piatto -->
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" name="description" id="description" placeholder="Inserisci la descrizione"
                maxlength="2000">{{ old('description') }}</textarea>
        </div>


        <!-- Selezione Ristorante -->
        <div class="form-group mb-3 d-none" hidden>
            <label class="form-label fw-bold" for="company_id">Ristorante *</label>
            <input type="hidden" class="form-control d-none" name="company_id" id="company_id"
                value="{{$selected_company}}">
            <input />
        </div>


        <!-- Immagine Piatto -->
        <div class="mb-3">
            <label for="image" class="form-label fb-bold">Carica un'immagine</label>
            <input class="form-control" type="file" name="image" id="image"
                accept=".jpg, .jpeg, .png, .bmp, .svg, .webp">
        </div>

        {{-- messaggio d'errore --}}
        <div>
            <p id="error-text-dish" class="text-danger"></p>
        </div>


        <!-- Bottone di Invo Form -->
        <button class="btn btn-primary">Crea</button>

    </form>
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


<script>
let switchDOMElement = document.getElementById('dish-visibility');

let switchValue = false;

switchDOMElement.addEventListener('click',function() {
    // console.log('click')
    switchValue = !switchValue;
    console.log('switch',switchValue);
    if(switchValue){
        document.getElementById('ciao').textContent = 'Piatto Disponibile';
      
    } else {

        document.getElementById('ciao').textContent = 'Piatto non Disponibile';
    }
}); 
</script>
@endsection