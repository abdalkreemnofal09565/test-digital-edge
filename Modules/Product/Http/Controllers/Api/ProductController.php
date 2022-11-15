<?php

namespace Modules\Product\Http\Controllers\Api;

use Illuminate\Foundation\Exceptions\Whoops\WhoopsHandler;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

use Modules\Product\Entities\Product;
use Modules\Product\Transformers\Product\ProductResource;

use Modules\Product\Http\Requests\Product\CreateRequest;
use Modules\Product\Http\Requests\Product\IndexRequest;
use Modules\Product\Http\Requests\Product\ShowRequest;
use Modules\Product\Http\Requests\Product\UpdateRequest;
use Modules\Product\Http\Requests\Product\DeleteRequest;
use Modules\Product\Services\ProductService;


class ProductController extends Controller
{
    public function index(IndexRequest $request){

        $user = Auth::user();
        
        if($user->hasRole('Admin')){
            if($request['user_id']){
                $data = QueryBuilder::for(Product::class)
			          ->with(['user'])
                      ->where('user_id',$request['user_id'])
                      ->paginate($request->query('per_page', 10));
               
            }else{
                $data = QueryBuilder::for(Product::class)
			          ->with(['user'])
                      ->paginate($request->query('per_page', 10));
            }
            
        }
        elseif($user->hasRole('User')){

            $data = QueryBuilder::for(Product::class)
			          ->with(['user'])
                      ->where('user_id',Auth::id())
                      ->paginate($request->query('per_page', 10));
                      
        }

        $data =  ProductResource::collection($data);
        return $data;
    }


    public function show(ShowRequest $request,$id){

        $data = Product::findOrFail($id)->loadMissing(['user']);  
        $data = new ProductResource($data);

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function store(CreateRequest $request){
        if(!$request['user_id']){
            $request['user_id'] = Auth::id();
        }
        $data = ProductService::store($request);
        $data = new ProductResource($data);

        return response()->json([
            'data' => $data,
            'message' => __('Product created successfully'),
        ], 200);
    }

    public function update(UpdateRequest $request, $id){
        $data = ProductService::update($request, $id);
        $data = new ProductResource($data);
        return response()->json([
            'data' => $data,
            'message' => __('Product updated successfully'),
        ], 200);
    }

    public function destroy(DeleteRequest $request,$id){
        Product::find($id)->delete();

        return response()->json([
            'message' => __('Product deleted successfully'),
        ], 200);
    }
}