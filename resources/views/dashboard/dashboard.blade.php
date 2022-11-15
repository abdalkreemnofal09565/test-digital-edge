@php
  $user = Auth::user();
@endphp
@extends('dashboard.layouts.master')

@section('contents')

<div class="content-wrapper">

  @if(session()->has('success'))
  <div class="alert alert-success">
      {{ session()->get('success') }}
  </div>
  @endif

  @if(session()->has('error'))
  <div class="alert alert-danger">
      {{ session()->get('error') }}
  </div>
  @endif


  <div class="row mx-5">
      <div class="col mt-5">

        <div class="card card-primary card-outline">
          <div class="card-body row">
              <div class="col-6">
                  <h3 style="margin: 0">
                      Dashboard
                  </h3>
              </div>

          </div>
      </div>





            <div class="card p-4">
              <div class="card-body">
                <div class="card-title mb-3">You are logged in as</div>
                <p class="card-text">
                  User Name : <span class="font-weight-bold">{{$user->first_name}}</span>
                </p>
                <p class="card-text">
                  Identifier : <span class="font-weight-bold">{{$user->identifier}}</span>
                </p>
                <p class="card-text">
                  Role : <span class="font-weight-bold">{{$user->getRoleNames()[0]}}</span>
                </p>
              </div>
            </div><!-- /.card -->


      </div>
  </div>
</div>

@endsection