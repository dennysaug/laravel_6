<?php

namespace App\Http\Controllers\Sysadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $list = Category::all();
        $data = ['list'];
        return view('sysadmin.category.index', compact($data));
    }

    public function new()
    {
        return view('sysadmin.category.form');
    }

    public function edit(Category $category)
    {
        $data = [];

        if(!isset($category->id)) {
            $category = null;
        }

        array_push($data, 'category');

        return view('sysadmin.category.form', compact($data));
    }

    public function store(Category $category, CategoryRequest $request)
    {
        $input = $request->only('name');

        try {

            if(isset($category->id)) {
                $category->update($input);
            } else {
                Category::create($input);
            }

            return redirect()->route('sysadmin.category.index')->with('status',true)->with('msg', env('MSG_SUCCESS'));

        } catch (\Exception $e) {
            return redirect()->route('sysadmin.category.index')->with('status', false)->with('msg', $e->getMessage());
        }


    }

    public function delete(Category $category)
    {
        try {

            if(isset($category->id)) {
                $delete = $category->delete();
            }

            return redirect()->route('sysadmin.category.index')->with('status',true)->with('msg', env('MSG_SUCCESS'));

        } catch (\Exception $e) {

            return redirect()->route('sysadmin.category.index')->with('status', false)->with('msg', $e->getMessage());

        }


    }


}
