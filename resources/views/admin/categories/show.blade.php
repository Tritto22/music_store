@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>{{$category->name}}</h2>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{route("categories.edit", $category->id)}}">
                                <button type="button" class="btn btn-warning">Modifica</button>
                            </a>
                            <form action="{{route("categories.destroy", $category->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </div>
                        <div class="mb-4">
                            <strong>Slug: </strong>
                            {{$category->slug}}
                        </div>
                        <div class="mb-4">
                            @if (count($category->instruments) > 0)
                                <h3>Lista degli strumenti associati</h3>
                                <ul>
                                    @foreach ($category->instruments as $instrument)
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
