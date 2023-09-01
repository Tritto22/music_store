@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{$instrument->name}}</h2>
                    </div>

                    <div class="card-body">
                        <div class="mb-5 d-flex justify-content-center">
                            @if ($instrument->image)
                                <img class="w-100" src="{{asset("storage/{$instrument->image}")}}" alt="{{$instrument->title}}">
                            @endif
                        </div>
                        @if ($instrument->category)
                            <div class="mb-3">
                                <h4>Categoria: <span class="p-2 bg-dark text-white rounded-pill">{{$instrument->category->name}}</span></h4>
                            </div>
                        @endif

                        @if (count($instrument->tags) > 0)
                            <div class="mb-3">
                                <strong>Tags:</strong>
                                @foreach ($instrument->tags as $tag)
                                    <span class="badge badge-primary">{{$tag->name}}</span>
                                @endforeach
                            </div>
                        @endif

                        <p class="mb-4">
                            {{$instrument->description}}
                        </p>
                        <div class="mb-4">
                            <strong>Prezzo: </strong>
                            <span>{{$instrument->price}} €</span>
                        </div>
                        <div class="mb-4">
                            <strong>Codice Univoco: {{$instrument->code}}</strong>
                        </div>
                        <div class="mb-4">
                            <strong>Versione per mancini</strong>
                            @if ($instrument->left_handed_version)
                                <span>✅</span>
                            @else
                                <span>⛔</span>
                            @endif
                        </div>
                        <div class="mb-4">
                            <strong>Disponibilità: </strong>
                            @if ($instrument->available)
                                <span class="badge badge-success">Immediata</span>
                            @else
                                <span class="badge badge-warning">In arrivo</span>
                            @endif
                        </div>
                        <div class="mb-4">
                            <div class="mb-4">
                                <a href="{{route("instruments.edit", $instrument->id)}}">
                                <button type="button" class="btn btn-warning">Modifica</button>
                            </a>
                            </div>
                            <form action="{{route("instruments.destroy", $instrument->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </div>

                        <a href="{{url()->previous()}}">
                            <button type="button" class="btn btn-primary">Torna alla pagina precedente</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
