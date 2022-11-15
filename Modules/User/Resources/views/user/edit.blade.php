@extends('dashboard.layouts.master')

@section('contents')
    <div class="content-wrapper">

        <div class="row mx-5">
            <div class="col mt-5">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif

                <div class="card card-primary card-outline">
                    <div class="card-body row">
                        <div class="col-6">
                            <h3 style="margin: 0">
                                Edit Product
                            </h3>
                        </div>

                        <div class="col-6" style="text-align: right">
                            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary" title="add new">
                              <i class="fa fa-plus "></i>
                          </a>
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">
                              <i class="fa fa-bars"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card p-4">


                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                        style="width: 100%">
                        @csrf
                        @method('PUT')

                        <div class="row">
                           

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input name="first_name" type="text" class="form-control" id="first_name"
                                        value="{{ $user->first_name }}">
                                    <span class="mt-2" style="color: rgb(182, 13, 13)">{{ $errors->first('first_name') }}</span>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Last Name:</label>
                                    <input name="last_name" type="text" class="form-control" id="last_name"
                                        value="{{ $user->last_name }}">
                                    <span class="mt-2" style="color: rgb(182, 13, 13)">{{ $errors->first('last_name') }}</span>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="identifier">Email address Or phone:</label>
                                    <input name="identifier" type="identifier" class="form-control" id="identifier"
                                        value="{{ $user->identifier }}">
                                    <span class="mt-2"
                                        style="color: rgb(182, 13, 13)">{{ $errors->first('identifier') }}</span>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input name="password" type="password" class="form-control" id="password">
                                    <span class="mt-2"
                                        style="color: rgb(182, 13, 13)">{{ $errors->first('password') }}</span>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password:</label>
                                    <input name="confirm_password" type="confirm_password" class="form-control" id="confirm_password">
                                    <span class="mt-2"
                                        style="color: rgb(182, 13, 13)">{{ $errors->first('confirm_password') }}</span>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control select2" style="width: 100%;">
                                        @foreach ($roles as $role)
                                            @if ($role->name == $user->getRoleNames()[0])
                                                <option selected value="{{ $role->name }}">{{ $role->name }}</option>
                                            @else
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                         

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>


            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
            $('.select2').select2();


        });
    </script>

  