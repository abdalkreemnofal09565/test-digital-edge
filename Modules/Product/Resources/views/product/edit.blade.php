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
                            <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary" title="add new">
                              <i class="fa fa-plus "></i>
                          </a>
                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">
                              <i class="fa fa-bars"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card p-4">


                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                        style="width: 100%">
                        @csrf
                        @method('PUT')

                        <div class="row">
                           

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input name="name" type="text" class="form-control" id="name"
                                        value="{{ $product->name }}">
                                    <span class="mt-2" style="color: rgb(182, 13, 13)">{{ $errors->first('name') }}</span>
                                </div>
                            </div>

                          
                        

                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>User</label>
                                    <select name="user_id" class="form-control select2" style="width: 100%;">
                                        @foreach ($users as $user)
                                            @if ($user->id == $product->user_id)
                                                <option selected value="{{ $user->id }}">{{ $user->first_name.' '.$user->last_name }}</option>
                                            @else
                                                <option value="{{ $user->id }}">{{ $user->first_name.' '.$user->last_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            


                            
                       

                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input name="image" id="image" type="file" accept="image/*" class="form-control">
                            <span class="mt-2" style="color: rgb(182, 13, 13)">{{ $errors->first('image') }}</span>
                        </div>


                      
                        <div class="form-group">
                            <label for="text_editor">Description:</label>
                            <textarea name="description" id="summernote">
                                {{   $product->description }}
                    </textarea>
                            <span class="mt-2"
                                style="color: rgb(182, 13, 13)">{{ $errors->first('description') }}</span>
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

  
    <script>
        $('#image').fileInput({
            type: 'image',
            action: 'update',
            value: '{{$product->image}}'
        });

       
    </script>
@endpush
