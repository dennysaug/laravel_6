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

    public function new()
    {
        return view('sysadmin.user_group.form');
    }

    public function edit(UserGroup $userGroup)
    {
        $data = [];

        if(!isset($userGroup->id)) {
            $userGroup = null;
        }

        array_push($data, 'userGroup');

        return view('sysadmin.user_group.form', compact($data));
    }

    public function store(UserGroup $userGroup, UserGroupRequest $request)
    {
        $input = $request->only('name');

        try {

            if(isset($userGroup->id)) {
                $userGroup->update($input);
            } else {
                UserGroup::create($input);
            }

            return redirect()->route('sysadmin.user_group.index')->with('status',true)->with('msg', env('MSG_SUCCESS'));

        } catch (\Exception $e) {

            return redirect()->route('sysadmin.user_group.index')->with('status', false)->with('msg', $e->getMessage());

        }

    }

    public function delete(UserGroup $userGroup)
    {
        try {

            if(isset($userGroup->id)) {
                $delete = $userGroup->delete();
            }

            return redirect()->route('sysadmin.user_group.index')->with('status',true)->with('msg', env('MSG_SUCCESS'));

        } catch (\Exception $e) {

            return redirect()->route('sysadmin.user_group.index')->with('status', false)->with('msg', $e->getMessage());

        }


    }


}
