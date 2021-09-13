@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="alert alert-secondary" role="alert">
            <h4 class="alert-heading">Welcome Back Admin</h4>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="row justify-content-center">
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
            </div>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="row justify-content-center">
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
            </div>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">All Users</h3>
                </div>

                <div class="card-body">
                    <table class="table table-sm table-hover"">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->active == 1)
                                            <span class="badge badge-success badge-pill">Active</span>
                                        @else
                                            <a class="badge badge-danger badge-pill" href="">Not active</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->active == 0)
                                            <a class="btn btn-sm btn-success" href="" data-toggle="modal" data-target="#activate{{$user->id}}">Acitvate</a>
                                        @else
                                            <a class="btn btn-sm btn-danger" href="" data-toggle="modal" data-target="#deactivate{{$user->id}}">Deactivate</a>
                                        @endif
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="activate{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLabel">Are you sure about this?</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-center"> You are about to Activate this user</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-sm btn-success" onclick="event.preventDefault(); document.getElementById('active{{ $user->id }}').submit();">Activate</button>
                                                </div>

                                                <form id="active{{ $user->id }}" action="{{ route('activate.user', ['id'=> encrypt($user->id) ]) }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ Method_field('put') }}
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="deactivate{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLabel">Are you sure about this?</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-center">You are about to Deactivate this user</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault(); document.getElementById('notactive{{ $user->id }}').submit();">Deactivate</button>
                                                    <form id="notactive{{ $user->id }}" action="{{ route('deactivate.user', ['id'=> encrypt($user->id) ]) }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                        {{ Method_field('put') }}
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr> 
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
