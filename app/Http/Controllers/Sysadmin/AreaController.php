<?php

namespace App\Http\Controllers\Sysadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Area;

class AreaController extends Controller
{

    public function index()
    {
        $list = Area::all();
        $data = ['list'];
        return view('sysadmin.area.index', compact($data));
    }

    public function new()
    {
        return view('sysadmin.area.form');
    }

    public function edit(Area $area)
    {
        $data = [];

        if(!isset($area->id)) {
            $area = null;
        }

        array_push($data, 'area');

        return view('sysadmin.area.form', compact($data));
    }

    public function store(Area $area, AreaRequest $request)
    {
        $input = $request->only('name');

        try {

            if(isset($area->id)) {
                $area->update($input);
            } else {
                $stored = Area::create($input);
                gen_route($stored->toArray());
            }

            return redirect()->route('sysadmin.area.index')->with('status',true)->with('msg', env('MSG_SUCCESS'));

        } catch (\Exception $e) {

            return redirect()->route('sysadmin.area.index')->with('status', false)->with('msg', $e->getMessage());

        }

    }

    public function delete(Area $area)
    {
        try {

            if(isset($area->id)) {
                $delete = $area->delete();
            }

            return redirect()->route('sysadmin.area.index')->with('msg', env('MSG_SUCCESS'));

        } catch (\Exception $e) {

            return redirect()->route('sysadmin.area.index')->with('status', false)->with('msg', $e->getMessage());

        }


    }


}
