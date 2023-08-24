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
                        <form action="{{route("instruments.store")}}" method="POST">
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
                            <button type="submit" class="btn btn-primary">Aggiungi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
