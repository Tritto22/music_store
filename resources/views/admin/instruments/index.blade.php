@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ __('Lista strumenti') }}</h2>    
                    </div>

                    <div class="card-body">
                        <div class="mb-4">
                            <a href="{{route("instruments.create")}}">
                                <button type="button" class="btn btn-success">Aggiungi Nuovi Strumenti</button>
                            </a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Codice Univoco</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Prezzo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instruments as $instrument)
                                    <tr>
                                        <td>{{$instrument->id}}</td>
                                        <td>{{$instrument->name}}</td>
                                        <td>{{$instrument->code}}</td>
                                        <td>{{$instrument->slug}}</td>
                                        <td>{{$instrument->price}} €</td>
                                        <td>
                                            <a href="{{route("instruments.show", $instrument->id)}}">
                                                <button type="button" class="btn btn-info">Visualizza</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route("instruments.edit", $instrument->id)}}">
                                                <button type="button" class="btn btn-warning">Modifica</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{route("instruments.destroy", $instrument->id)}}" method="POST">
                                                @csrf
                                                @method("DELETE")
                                                
                                                <button type="button" class="btn btn-danger">Elimina</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
