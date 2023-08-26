@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Aggiungi un nuovo strumento</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route("instruments.store")}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome dello strumento" value="{{old("name")}}">
                                @error('name')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">Codice Univoco</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="Inserisci il codice univoco" value="{{old('code')}}">
                                @error('code')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Descrizione del prodotto</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Inserisci la descrizione del prodotto" rows="6" value="{{old('description')}}"></textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Prezzo</label>
                                <input type="number" step="any" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Inserisci le cifre del prezzo separate dal '.'" value="{{old('price')}}">
                                @error('price')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category">Categoria</label>
                                <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id" id="category">
                                    <option value="">Seleziona una categoria</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{old("category_id") == $category->id ? "selected" : ""}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input @error('left_handed_version') is-invalid @enderror" id="left_handed_version" name="left_handed_version" {{old('left_handed_version') ? 'checked' : ''}}>
                                <label class="form-check-label" for="left_handed_version">E' presente la versione per mancini</label>
                                @error('left_handed_version')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input @error('available') is-invalid @enderror" id="available" name="available" {{old('available') ? 'checked' : ''}}>
                                <label class="form-check-label" for="available">Il prodotto è già in magazzino</label>
                                @error('available')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="custom-file mb-3">
                                <img id="uploadPreview" width="100" class="mt-5" src="https://via.placeholder.com/300x200">
                                <input type="file" class="custom-file-input" id="image" name="image" onchange="PreviewImage();">
                                <label class="custom-file-label" for="image">Aggiungi immagine</label>

                                {{-- script per il funzionamento dell'input dell'immagine con bootstrap --}}
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Aggiungi un event listener per il campo di input del file
                                        const fileInput = document.getElementById('image');
                                        const fileLabel = fileInput.nextElementSibling;

                                        fileInput.addEventListener('change', function() {
                                            // Aggiorna il testo della label con il nome del file selezionato
                                            const fileName = this.files[0].name;
                                            fileLabel.innerText = fileName;
                                        });
                                    });
                                </script>

                                {{-- script per la preview dell'immagine caricata, richiama la funzione con onchange di input--}}
                                <script type="text/javascript">

                                    function PreviewImage() {
                                        var oFReader = new FileReader();
                                        oFReader.readAsDataURL(document.getElementById("image").files[0]);

                                        oFReader.onload = function (oFREvent) {
                                            document.getElementById("uploadPreview").src = oFREvent.target.result;
                                        };
                                    };
                                </script>

                                @error('image')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <p>Tags</p>
                                @foreach ($tags as $tag)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input @error('tags') is-invalid @enderror" id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}" {{in_array($tag->id, old("tags", [])) ? 'checked' : ''}}>
                                        <label class="form-check-label" for="{{$tag->slug}}">{{$tag->name}}</label>
                                    </div>
                                @endforeach
                                @error('tags')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Aggiungi</button>
                        </form>
                        
                        <div class="mt-4">
                            <a href="{{url()->previous()}}">
                                <button type="button" class="btn btn-primary">Torna alla pagina precedente</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
