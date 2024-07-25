@extends('layouts.app')
@section('title', $dish->name)

@section('content')
<div class="container bg-light mt-5 mb-5 rounded-4 p-5 text-blue shadow">
    <h1>Modifica le informazioni del tuo piatto</h1>

    <!-- Immagine Piatto -->
    @if($dish->image)
        <img src="{{ asset('storage/' . $dish->image) }}" alt="image{{$dish->name}}" class="card-img-top w-50 my-edit-img">
    @else
        <img src="{{  asset('storage/image/default-image.png') }} " class="card-img-top w-50" alt="...">
    @endif

    <form action="{{ route('admin.dishes.update', $dish)}}" method="POST" class="my-dish-form"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nome Piatto -->
        <div class="mb-3">
            <label for="name" class="form-label fb-bold">Nome *</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Inserisci il nome"
                value="{{ old('name', $dish->name) }}" maxlength="250">
        </div>

        <!-- Prezzo Piatto -->
        <div class="mb-3">
            <label for="price" class="form-label fb-bold">Prezzo( € ) *</label>
            <input type="number" class="form-control" name="price" id="price" step=".01"
                placeholder="Inserisci il Prezzo (Es 10.00)" value="{{ old('price', $dish->price) }}">
        </div>

        <!-- Visibilità Piatto -->
        <div class="mb-3">
            <div class="mb-3">
                <label for="visible" class="form-label fb-bold">Disponibilità nel Menù *</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="dish-visibility"
                        name="visible" @if(old('visible', $dish->visible ?? false)) checked @endif value="1">
                </div>
                <p id="ciao">{{$dish->visible ? 'Piatto Disponibile' : 'Piatto non Disponibile'}}</p>
            </div>


            <!-- Ingredienti Piatto -->
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredienti *</label>
                <textarea class="form-control" name="ingredients" id="ingredients"
                    placeholder="Inserisci la descrizione" data-required="true"
                    maxlength="2000">{{ old('ingredients', $dish->ingredients)}}</textarea>
            </div>


            <!-- Descrizione Piatto -->
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" name="description" id="description"
                    placeholder="Inserisci la descrizione"
                    maxlength="2000">{{ old('description', $dish->description)}}</textarea>
            </div>


            <!-- Immagine Piatto -->
            <div class="mb-3">
                <label for="image" class="form-label fb-bold">Cambia la tua immagine</label>
                <input class="form-control" type="file" name="image" id="image"
                    accept=".jpg, .jpeg, .png, .bmp, .svg, .webp">
            </div>


            {{-- messaggio d'errore --}}
            <div>
                <p id="error-text-dish" class="text-danger"></p>
            </div>


        </div>
        <button class="btn btn-primary">Modifica</button>
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