@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <form action="/login" method="post">
                    @csrf
                        Email
                        <input type="email" name="email" id="email" class="form-control" required>
                        Password
                        <input type="password" name="password" id="password" class="form-control" required><br>
                        <input type="submit" value="Login" class="btn btn-primary"><br><br>
                        @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{Session::get('error')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                </form> 
            </div>

            <div class="col-md-8" id="messages">
                
            </div>
        </div>
    </div>
@endsection