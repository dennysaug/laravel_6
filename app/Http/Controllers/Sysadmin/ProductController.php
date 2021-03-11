<?php

namespace App\Http\Controllers\Sysadmin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $list = Product::all();
        $data = ['list'];
        return view('sysadmin.product.index', compact($data));
    }

    public function new()
    {
        $data = ['categories'];

        $categories = Category::all()->pluck('name','id')->toArray();

        return view('sysadmin.product.form', compact($data));
    }

    public function edit(Product $product)
    {
        $data = ['categories'];

        $categories = Category::all()->pluck('name','id')->toArray();

        if(!isset($product->id)) {
            $product = null;
        }

        array_push($data, 'product', 'categories');

        return view('sysadmin.product.form', compact($data));
    }

    public function store(Product $product, ProductRequest $request)
    {
        $input = $request->except('_token');

        try {

            if(isset($product->id)) {
                $product->update($input);
            } else {
                $product = Product::create($input);
            }

            $upload['files'] = $request->file('images');

            $upload['path'] = storage_path('app/public/images/product/');
            $msg = '';
            if(count($upload['files'])) {
                $returnUpload = uploadImagem($upload);

                if(isset($returnUpload['images']) && count($returnUpload['images'])) {
                    $dbImages = [];
                    foreach ($returnUpload['images'] as $image) {
                        $dbImages[] = ProductImage::create(['product_id' => $product->id, 'name' => $image]);
                    }
                    $msg .= '. ' . count($upload['files']) . '/' . count($dbImages) . ' image(s) upload';
                }



            }

            return redirect()->route('sysadmin.product.index')->with('status',true)->with('msg', env('MSG_SUCCESS').$msg);

        } catch (\Exception $e) {
            return redirect()->route('sysadmin.product.index')->with('status', false)->with('msg', $e->getMessage());
        }

    }

    public function order(Request $request)
    {
        $input = $request->only('item');
        if(count($input)>0) {
            foreach($input['item'] as $order => $id) {
//                dump(['order' => $order, 'id' => $id]);
                ProductImage::find($id)->update(['order' => $order+1]);
            }
        }


    }

    public function delete(Product $product)
    {
        try {

            if(isset($product->id)) {
                $delete = $product->delete();
            }

            return redirect()->route('sysadmin.product.index')->with('status',true)->with('msg', env('MSG_SUCCESS'));

        } catch (\Exception $e) {

            return redirect()->route('sysadmin.product.index')->with('status', false)->with('msg', $e->getMessage());

        }


    }


}
