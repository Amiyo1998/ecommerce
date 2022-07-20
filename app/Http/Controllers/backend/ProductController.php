<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $data['title'] = __("Product");
        $data['products'] = Product::with('category')->latest()->paginate(6);
        return view('backend.pages.product.index', $data);
    }
    public function create()
    {
        $data['title'] = __("Product/Create");
        $data['categories'] = Category::select('id','name')->get();
        return view('backend.pages.product.create', $data);
    }
    public function store(ProductRequest $request)
    {
        $path = '';
        if($request->hasFile("image")){
            $path = $request->file("image")->store('images/products');
        }
        $product =Product::create([
            'cat_id' =>$request->get('cat_id'),
            'name' =>$request->get('name'),
            'slug' =>$request->get('slug'),
            'small_description' =>$request->get('small_description'),
            'description' =>$request->get('description'),
            'orginal_price' =>$request->get('orginal_price'),
            'seller_price' =>$request->get('seller_price'),
            'qty' =>$request->get('qty'),
            'tax' =>$request->get('tax'),
            'keyword' =>$request->get('keyword'),
            'image' => $path
        ]);
        if(empty($product))
        {
            return redirect()->back();
        }
        return redirect()->route('products.index')->with('message', 'Product created successfull!!');
    }
    public function show($id)
    {
        //
    }
    public function edit(Product $product)
    {
        $data['title'] = __("Product/Edit");
        $data['product'] = $product;
        return view('backend.pages.product.edit', $data);
    }
    public function update(ProductRequest $request, Product $product)
    {
        $path = '';
        if($product->image){
            Storage::delete($product->image);
        }
        if($request->hasFile("image")){
            $path = $request->file("image")->store('images/products');
        }
        $params = $request->only(['cat_id','name','slug','small_description','description','orginal_price','seller_price','qty','tax','keyword',
        ]);
        $params['image'] = $path;
        if($product->update($params))
        {
            return redirect()->route('products.index')->with('message', 'Product edited successfull!!');
        }
    }
    public function destroy(Product $product)
    {
        if( Storage::delete($product->image)){
            $product->delete();
        }
        return redirect()->route('products.index')->with('message', 'Product deleted successfull!!');
    }
}
