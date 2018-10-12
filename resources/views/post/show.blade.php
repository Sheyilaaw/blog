@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="jumbotron">
                            <h2 class="display-3">{{$post['title']}}</h2>
                            <p class="lead">
                                {{$post['body']}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
