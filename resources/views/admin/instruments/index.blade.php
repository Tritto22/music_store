@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Lista strumenti') }}</div>

                    <div class="card-body">
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
