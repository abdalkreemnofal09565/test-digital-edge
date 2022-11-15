@extends('dashboard.layouts.master')



@section('contents')

<div class="content-wrapper">

    <div class="row mx-5">
        <div class="col mt-5">

                        <div class="card card-primary card-outline">
                            <div class="card-body row">
                                <div class="col-6">
                                    <h3 style="margin: 0">
                                        Details
                                    </h3>

                                </div>
                                <div class="col-6" style="text-align: right">
                                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary" title="add new">
                                        <i class="fa fa-plus "></i>
                                    </a>
                                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary" title="show all">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="card p-4">

                                <table class="table table-bordered mb-5 show-table">
                                    <tbody>
                                        <tr>
                                            <th>ID:</th>
                                            <td>{{ $user->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>First Name:</th>
                                            <td>{{ $user->first_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Name:</th>
                                            <td>{{ $user->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email Or phone:</th>
                                            <td>{{ $user->identifier }}</td>
                                        </tr>
                                        <tr>
                                            <th>Role:</th>
                                            <td>{{ $user->getRoleNames()[0] }}</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                 
                        </div>

              

            </div>
        </div>

    </div>
@endsection
