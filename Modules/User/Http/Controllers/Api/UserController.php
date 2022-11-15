<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Request;

use App\Models\User;
use Modules\User\Transformers\User\UserResource;
use Modules\User\Http\Requests\User\CreateRequest;
use Modules\User\Http\Requests\User\UpdateRequest;
use Modules\User\Http\Requests\User\DeleteRequest;
use Modules\User\Http\Requests\User\IndexRequest;
use Modules\User\Http\Requests\User\ShowRequest;
use Modules\User\Services\UserService;


class UserController extends Controller
{
    public function index(IndexRequest $request){

        $data = QueryBuilder::for(User::class)
            ->paginate($request->query('per_page', 10));

        $data =  UserResource::collection($data);
        return $data;
    }


    public function show(ShowRequest $request,$id){

        $data = User::findOrFail($id);  
        $data = new UserResource($data);

        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function store(CreateRequest $request){

        $data = UserService::store($request);
        $data = new UserResource($data);

        return response()->json([
            'data' => $data,
            'message' => __('User created successfully'),
        ], 200);
    }

    public function update(UpdateRequest $request, $id){
        $data = UserService::update($request, $id);
        $data = new UserResource($data);
        return response()->json([
            'data' => $data,
            'message' => __('User updated successfully'),
        ], 200);
    }

    public function destroy(DeleteRequest $request,$id){
        User::find($id)->delete();

        return response()->json([
            'message' => __('User deleted successfully'),
        ], 200);
    }
}