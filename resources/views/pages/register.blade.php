@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <form action="#" method="post" id="forma">
                    @csrf
                        Username
                        <input type="text" name="username" id="username" class="form-control info" required>
                        Email
                        <input type="email" name="email" id="email" class="form-control info" required>
                        Password
                        <input type="password" name="password" id="password" class="form-control info" required>
                        Confirm Password
                        <input type="password" name="cfpassword" id="cfpassword" class="form-control info" required><br>
                        <input type="submit" value="Register" class="btn btn-primary"><br><br>
                        <div class="alert" role="alert" id="errors">
                            
                        </div>
                </form> 
            </div>

            <div class="col-md-8" id="messages">

            </div>
        </div>
    </div>
@endsection

@section('aditionalJS')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/register.js') }}"></script>
@endsection