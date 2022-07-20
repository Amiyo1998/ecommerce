<?php

namespace App\Http\Controllers\frontend;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CartsController extends Controller
{

    public function index()
    {
        $data['title'] = __("Cart");
        $data['carts'] = Cart::with('product')->get();
        $data['subtotal'] = Cart::all()->where('ip_address', request()->ip())->sum(
            function($t){
               return $t->price * $t->product_qnty;
            });
        return view('frontend.pages.shopingCart',$data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $cart = Cart::orWhere('ip_address', request()->ip())
                    ->where('product_id',$request->get('product_id'))
                    ->first();
        if(!is_null($cart)){
            $cart->increment('product_qnty');
        }else{
            $cart =Cart::create([
                'product_id' =>$request->get('product_id'),
                'product_qnty' => 1,
                'ip_address' => request()->ip(),
                'price' =>$request->get('price'),
            ]);
        }

        if(empty($cart))
        {
            return redirect()->back('message', 'Product empty!!');
        }
        return back()->with('message', 'Product has added to cart!!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Cart $cart)
    {
        //
    }

    public function update(Request $request, Cart $cart)
    {
        $data['cart'] = $cart;
        $params = $request->only(['product_qnty']);
        if($cart->update($params))
        {
            return redirect()->back()->with('message', 'Cart Updated successfull!!');
        }
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->back()->with('message', 'Cart deleted successfull!!');
    }
}
