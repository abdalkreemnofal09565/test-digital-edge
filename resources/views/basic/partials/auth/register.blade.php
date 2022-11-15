@extends('basic.layouts.master')

@section('content')
<div class="container">
    <div class="card mt-5" style="max-width: 350px; margin:auto">
          <div class="card-header" style="text-align: center">
              Register
          </div>
          <div class="card-body">
              <form method="POST" action="{{route('register.post')}}">
                @csrf
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input name="first_name" type="text" class="form-control" id="first_name" placeholder="First Name">
                    <span class="mt-2" style="color: rgb(182, 13, 13)">{{$errors->first('first_name')}}</span>    
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Last Name">
                    <span class="mt-2" style="color: rgb(182, 13, 13)">{{$errors->first('last_name')}}</span>    
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email or Phone</label>
                    <input name="identifier" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email or Phone">
                    <span class="mt-2" style="color: rgb(182, 13, 13)">{{$errors->first('identifier')}}</span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    <span class="mt-2" style="color: rgb(182, 13, 13)">{{$errors->first('password')}}</span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">ConfirmPassword</label>
                    <input name="confirm_password" type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password">
                    <span class="mt-2" style="color: rgb(182, 13, 13)">{{$errors->first('confirm_password')}}</span>
                </div>
                  <button type="submit" class="btn btn-primary mt-3">register</button>
                </form>
          </div>
    </div>
  </div>
@endsection