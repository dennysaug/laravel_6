<?php

namespace App\Http\Controllers\Sysadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserGroupRequest;
use App\UserGroup;

class UserGroupController extends Controller
{
    
    public function index()
    {
        $list = UserGroup::all();
        $data = ['list'];
        return view('sysadmin.user_group.index', compact($data));
    }

    public function form(UserGroup $userGroup)
    {
        $data = [];

        if(!isset($userGroup->id)) {
            $suserGroup = null;
        }

        array_push($data, 'userGroup');

        return view('sysadmin.user_group.form', compact($data));
    }

    public function store(UserGroup $userGroup, UserGroupRequest $request)
    {
        $input = $request->only('name');

        if(isset($userGroup->id)) {
            $stored = $userGroup->update($input);
        } else {
            $stored = UserGroup::create($input);

        }

        return redirect()->route('sysadmin.user_group.index')->with('status', 'The register was stored with successful');
    }

    public function delete(UserGroup $userGroup)
    {
        if(isset($userGroup->id)) {
            $delete = $userGroup->delete();
        }

        return redirect()->route('sysadmin.user_group.index')->with('status', 'The register was deleted with successful');
    }

   
}