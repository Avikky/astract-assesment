@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($user->active == 0)
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading text-center">Registration successfully!</h4>
                <p class="text-center">
                    Thank you for registring, you will not be able to login to your  account utill your account is activated,
                    you will be able to login once your account is activated.  
                </p>
            </div>
        @else
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Account activated you can  now login!</h4>
                <p class="row justify-content-center">
                    <a class="btn btn-primary b" href="{{ route('login')}}">Login here</a>
                </p>
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Registration details</div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Name: {{$user->name}}
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Email: {{$user->email}}
                            
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Password: {{$password}}
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @if($user->active == 1)
                                Status:
                                <span class="badge badge-success badge-pill">Active</span>
                            @else
                                Status
                            <span class="badge badge-danger badge-pill">Not Active</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
