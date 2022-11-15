<?php

namespace Modules\Product\Http\Controllers\Session;


use Datatables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Product\Entities\Product;
use Illuminate\Routing\Controller;
use Modules\Product\Services\ProductService;
use Modules\Product\DataTables\ProductDataTable;
use Illuminate\Contracts\Support\Renderable;
use Modules\Product\Http\Requests\Product\ShowRequest;
use Modules\Product\Http\Requests\Product\CreateRequest;
use Modules\Product\Http\Requests\Product\IndexRequest;

use Modules\Product\Http\Requests\Product\UpdateRequest;
use Modules\Product\Http\Requests\Product\DeleteRequest;

class ProductController extends Controller
{

    public function index(IndexRequest $request, ProductDataTable $dataTable){
        return $dataTable->with('user_id' , $request['user_id'])->render('product::product.index');
    }


    public function create()
    {
        $users = User::all();
        return view('product::product.create', compact('users'));
    }

    public function store(CreateRequest $request)
    {

        if(!$request['user_id']){
            $request['user_id'] = Auth::id();
        }
        $product = ProductService::store($request);
        return back()->with('success', 'Product created successfully');
    }

    public function show(ShowRequest $request,$id){
        $product = Product::find($id);
        return view('product::product.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $users = User::all();
        return view('product::product.edit', compact('product', 'users'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $product = ProductService::update($request, $id);
        return back()->with('success', 'Product updated Successfully');
    }

    public function destroy(UpdateRequest $request,$id)
    {
        Product::find($id)->delete();
        return back()->with('success', 'Product deleted successfully');
    }
}
