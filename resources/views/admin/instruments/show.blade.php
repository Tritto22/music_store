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
                        @if ($instrument->category)
                            <div class="mb-3">
                                <h4>Categoria: <span class="p-2 bg-dark text-white rounded-pill">{{$instrument->category->name}}</span></h4>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
