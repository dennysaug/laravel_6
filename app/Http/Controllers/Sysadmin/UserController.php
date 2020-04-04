<?php

namespace App\Http\Controllers\Sysadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use App\UserGroup;

class UserController extends Controller
{
    
    public function index()
    {
        $list = User::all();
        $data = ['list'];
        return view('sysadmin.user.index', compact($data));
    }

    public function form(User $user)
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
        
        $input = $request->only('name');

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

   
}
