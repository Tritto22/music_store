@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Modifica {{$instrument->name}}</h2>
                    </div>

                    <div class="card-body">
                        <form action="{{route("instruments.update", $instrument->id)}}" method="POST">
                            @csrf
                            @method("PUT")

                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome dello strumento" value="{{old('name') ? old('name') : $instrument->name}}">
                                @error('name')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">Codice Univoco</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="Inserisci il codice univoco" value="{{old('code') ? old('code') : $instrument->code}}">
                                @error('code')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Descrizione del prodotto</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Inserisci la descrizione del prodotto" rows="6">{{old('description') ? old('description') : $instrument->description}}</textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Prezzo</label>
                                <input type="number" step="any" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Inserisci le cifre del prezzo separate dal '.'" value="{{old('price') ? old('price') : $instrument->price}}">
                                @error('price')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input @error('left_handed_version') is-invalid @enderror" id="left_handed_version" name="left_handed_version" {{old('left_handed_version', $instrument->left_handed_version) ? 'checked' : ''}}>
                                <label class="form-check-label" for="left_handed_version">E' presente la versione per mancini</label>
                                @error('left_handed_version')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input @error('available') is-invalid @enderror" id="available" name="available" {{old('available', $instrument->available) ? 'checked' : ''}}>
                                <label class="form-check-label" for="available">Il prodotto è già in magazzino</label>
                                @error('available')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Modifica</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
