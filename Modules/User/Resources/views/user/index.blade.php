@extends('dashboard.layouts.master')

@section('contents')
    <div class="content-wrapper">

        <div class="row mx-5">
            <div class="col mt-5">

                <div class="card card-primary card-outline">
                    <div class="card-body row">
                        <div class="col-6">
                            <h3 style="margin: 0">
                                Product
                            </h3>
                        </div>

                        <div class="col-6" style="text-align: right">
                            @can('user.create')
                                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus"></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>




                <div class="card p-4">

                        {!! $dataTable->table() !!}
   
                </div>


            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! $dataTable->scripts() !!}
@endpush
