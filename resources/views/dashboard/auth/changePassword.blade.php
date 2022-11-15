@extends('basic.layouts.master')

@section('content')
<div class="container">
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    <div class="card mt-5" style="max-width: 350px; margin:auto">
          <div class="card-header" style="text-align: center">
              change password
          </div>
          <div class="card-body">
              <form method="POST" action="{{route('dashboard.change.password')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputPassword1">Current Password</label>
                    <input name="current_password" type="current_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    <span class="mt-2" style="color: rgb(182, 13, 13)">{{$errors->first('current_password')}}</span>
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
                  <button type="submit" class="btn btn-primary mt-3">change</button>
                </form>
          </div>
    </div>
  </div>
@endsection