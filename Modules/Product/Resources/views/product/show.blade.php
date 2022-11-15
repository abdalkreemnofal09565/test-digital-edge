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
                                    @can('products.create')
                                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary" title="add new">
                                        <i class="fa fa-plus "></i>
                                    </a>
                                    @endcan
                                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary" title="show all">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="card p-4">

                                <table class="table table-bordered mb-5 show-table">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $product->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $product->name }}</td>
                                        </tr>
                                        
                                     
                                        <tr>
                                            <th>Image</th>
                                            <td>
                                                @if ($product->image)
                                                  <img src="{{ asset($product->image) }}" class="img-thumbnail" width="150px">
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{!! $product->description !!}</td>
                                        </tr>
                                        
                                      
                                       
                                    </tbody>
                                </table>
                 
                        </div>

              

            </div>
        </div>

    </div>
@endsection
