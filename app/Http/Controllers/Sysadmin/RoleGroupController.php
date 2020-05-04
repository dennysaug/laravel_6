<?php

namespace App\Http\Controllers\Sysadmin;

use App\Area;
use App\Http\Controllers\Controller;
use App\User;
use App\UserGroup;
use Illuminate\Http\Request;

class RoleGroupController extends Controller
{

    public function index()
    {
        $list = UserGroup::all();
        $data = ['list'];

        return view('sysadmin.role_group.index', compact($data));
    }

    public function edit(UserGroup $userGroup)
    {
        $data = [];

        if(!isset($userGroup->id)) {
            abort(404);
        }

        $roleGroups = $userGroup->role_groups->pluck('id')->toArray();


        $areas = Area::all();

        array_push($data, 'userGroup', 'areas', 'roleGroups');

        return view('sysadmin.role_group.form', compact($data));
    }

    public function store(UserGroup $userGroup, Request $request)
    {
        $input = $request->input('roles');

        try {

            $users = User::where('user_group_id', $userGroup->id)->get();

            $userGroup->role_groups()->sync($input);

            if(count($users)) {
                foreach($users as $user) {
                    $user->permissions()->sync($input);
                }
            }

            return redirect()->route('sysadmin.role_group.index')->with('status', 'The register was stored with successful');

        } catch (\Exception $e) {

            return redirect()->route('sysadmin.role_group.index')->with('status', false)->with('msg', $e->getMessage());

        }


    }
}
