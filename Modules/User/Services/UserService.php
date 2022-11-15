<?php

namespace Modules\User\Services;
use App\Traits\FileHandler;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserService{

    public static function store($request){
        $data = $request->toArray();

        $data['password'] ? $data['password'] = Hash::make($data['password']) : null;

       
        $test = User::create($data);
        if(isset($data['role'])){
            $test->assignRole($data['role']);
        }
        return $test;
    }




    public static function update($request, $id){
        $test = User::find($id);
        $data = $request->toArray();
    

        if(is_null($data['password'])){
            $data['password'] = $test->password;    
        }else{ $data['password'] = Hash::make($data['password']); }
        
        if(isset($data['role'])){
            $test->assignRole($data['role']);
        }
        $test->update($data);
        return $test;
    }
}