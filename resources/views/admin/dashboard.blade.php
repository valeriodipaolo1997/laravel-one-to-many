@extends('layouts.admin')

@section('content')
<div class="container">
<div class="d-flex justify-content-between py-4 align-items-center">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>

        <a class="btn btn-primary" href="{{ route('admin.projects.index') }}"> Table Project </a>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card text-center">
            <div class="card-header text-uppercase">
                    users <i class="fa-solid fa-user-group fa-xs"></i>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    Welcome {{Auth::user()->name}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
