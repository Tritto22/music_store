@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{$tag->name}}</h2>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{route("tags.edit", $tag->id)}}">
                                <button type="button" class="btn btn-warning">Modifica</button>
                            </a>
                            <form action="{{route("tags.destroy", $tag->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </div>
                        <div class="mb-4">
                            <strong>Slug: </strong>
                            {{$tag->slug}}
                        </div>
                        <div class="mb-4">
                            @if (count($tag->instruments) > 0)
                                <h3>Lista dei tag associati</h3>
                                <ul>
                                    @foreach ($tag->instruments as $instrument)
                                        <li>{{$instrument->name}}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
