<?php

namespace App\Http\Controllers\Sysadmin;

use App\Area;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use App\UserGroup;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $list = User::all();
        $data = ['list'];
        return view('sysadmin.user.index', compact($data));
    }

    public function new()
    {
        return view('sysadmin.user.form');
    }

    public function edit(User $user)
    {
        $data = [];

        if(!isset($user->id)) {
            $user = null;
        }

        $userGroups = UserGroup::pluck('name','id')->toArray();

        array_push($data, 'user', 'userGroups');

        return view('sysadmin.user.form', compact($data));
    }

    public function store(User $user, UserRequest $request)
    {

        $input = $request->except('_token');

        if(isset($user->id)) {
            $stored = $user->update($input);
        } else {
            $stored = UserGroup::create($input);

        }

        return redirect()->route('sysadmin.user.index')->with('status', 'The register was stored with successful');
    }

    public function delete(User $user)
    {
        if(isset($user->id)) {
            $delete = $user->delete();
        }

        return redirect()->route('sysadmin.user.index')->with('status', 'The register was deleted with successful');
    }

    public function permission(User $user, Request $request)
    {
        $rolesUser = $user->permissions->pluck('id')->toArray();
        $areas = Area::all();

        $data = ['user', 'rolesUser', 'areas'];

        if ($request->isMethod('post')) {
            if (isset($user->id)) {
                $input = $request->input('roles');
                $user->permissions()->sync($input);

                return redirect()->route('sysadmin.user.index')->with('status', 'The register was updated with successful');

            } else {
                $status = '0';
                $msg = 'User not found';
            }
        }

        return view('sysadmin.user.permission',compact($data));
    }


}
