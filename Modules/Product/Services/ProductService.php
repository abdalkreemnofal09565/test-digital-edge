<?php

namespace Modules\Product\Services;
use App\Traits\FileHandler;

use Illuminate\Support\Facades\Hash;
use Modules\Product\Entities\Product;
use Modules\User\Entities\User;

class ProductService{

    public static function store($request){
        $data = $request->toArray();

        $data['image'] = FileHandler::store($request, 'image', 'single', 'image', 'Product', 'webp');

        $test = Product::create($data);
        return $test;
    }




    public static function update($request, $id){
        $test = Product::find($id);
        $data = $request->toArray();
    
        $data['image'] = FileHandler::update($request, $test->image, 'image', 'single', 'image', 'Product', 'webp');
       
        $test->update($data);
        return $test;
    }
}