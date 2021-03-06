@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @foreach($posts as $post)
                        <div class="col-md-12">
                            <div class="jumbotron">
                                <h2 class="display-3">{{$post->title}}</h2>
                                <p class="lead">
                                    {{$post->body}}
                                </p>
                                <p class="lead">
                                    <a class="btn btn-primary btn-lg" href="/post/{{$post->id}}" role="button">Learn more</a>
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
