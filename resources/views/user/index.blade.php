@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registered Users</div>

                    <div class="card-body">
                        @foreach($users as $user)
                            <div class="col-md-12">
                                <div class="jumbotron">
                                    <h2 class="display-3">{{$user->name}}</h2>
                                    <p class="lead">
                                        {{$user->email}}
                                    </p>
                                    <p class="lead">
                                        <a class="btn btn-primary btn-lg" href="/user/{{$user->id}}/edit" role="button">View Profile</a>
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
