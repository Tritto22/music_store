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
                        <div class="mb-4">
                            <strong>Slug: </strong>
                            {{$category->slug}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
