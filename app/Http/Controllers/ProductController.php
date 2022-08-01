<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index()
    {
        return view('dashboard.products.products')->with('products', Product::orderBy('id','DESC')->get());
    }


    public function create()
    {
        return view('dashboard.products.create_product');
    }


    public function store(ProductRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = ['name'=>$request->name];
        Product::create($data);
        return Redirect::route('products.index')->with('status', 'کالا با موفقیت اضافه شد');

    }


    public function edit($id)
    {
        return view('dashboard.products.update_product')->with('product', Product::find($id));
    }


    public function update(ProductRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $product = Product::find($id);
        $data = ['name'=>$request->name];
        $product->update($data);
        return Redirect::route('products.index')->with('status', 'کالا با موفقیت ویرایش شد');
    }


    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        Product::find($id)->delete();
        return Redirect::route('products.index')->with('status', 'کالا با موفقیت حذف شد');
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->keyword . '%')->orderBy('id','DESC')->get();
        return view('dashboard.products.products')->with(['products'=> $products,'keyword'=>$request->keyword]);

    }
}
