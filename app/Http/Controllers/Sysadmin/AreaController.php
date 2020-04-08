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

    public function form(Area $area)
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

        if(isset($area->id)) {
            $stored = $area->update($input);
        } else {
            $stored = Area::create($input);

        }

        return redirect()->route('sysadmin.area.index')->with('status', 'The register was stored with successful');
    }

    public function delete(Area $area)
    {
        if(isset($area->id)) {
            $delete = $area->delete();
        }

        return redirect()->route('sysadmin.area.index')->with('status', 'The register was deleted with successful');
    }


}
