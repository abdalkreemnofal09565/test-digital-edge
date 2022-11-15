<?php

namespace Modules\User\Http\Controllers\Session;


use Datatables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Services\UserService;
use Modules\User\DataTables\UserDataTable;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Http\Requests\User\CreateRequest;
use Modules\User\Http\Requests\User\UpdateRequest;
use Modules\User\Http\Requests\User\DeleteRequest;
use Modules\User\Http\Requests\User\IndexRequest;
use Modules\User\Http\Requests\User\ShowRequest;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index(IndexRequest $request, UserDataTable $dataTable){

        return $dataTable->render('user::user.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('user::user.create', compact('roles'));
    }

    public function store(CreateRequest $request)
    {
        
        $user = UserService::store($request);
        return back()->with('success', 'User created successfully');
    }

    public function show(ShowRequest $request,$id){
        $user = User::find($id);
        return view('user::user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user::user.edit', compact('user', 'roles'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $user = UserService::update($request, $id);
        return back()->with('success', 'User updated Successfully');
    }

    public function destroy(DeleteRequest $request,$id)
    {
        User::find($id)->delete();
        return back()->with('success', 'User deleted successfully');
    }
}
