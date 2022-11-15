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
            Login
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('login.post')}}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Email or Phone</label>
                  <input name="identifier" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email or phone">
                  <span class="mt-2" style="color: rgb(182, 13, 13)">{{$errors->first('identifier')}}</span>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  <span class="mt-2" style="color: rgb(182, 13, 13)">{{$errors->first('password')}}</span>
                </div>
                <button type="submit" class="btn btn-primary mt-3">login</button>
                {{-- <span style="float: right;line-height: 70px;">
                  <a href="{{route('forget.password.get')}}">forget password ?</a>
                </span> --}}
              </form>
        </div>
  </div>
</div>
@endsection