<?php

namespace App\Http\Controllers\frontend;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Contracts\Session\Session;

class PageController extends Controller
{
    public function home()
    {
        $data['title'] =__("Home");
        $data['categories'] = Category::all();
        $data['products'] = Product::all();
        $data['its_lm'] = Product::limit(3)->get();
        $data['bannaer_pro'] = Product::limit(1)->latest()->get();
        $data['cartcount'] = Cart::all()->count();
        return view('frontend.pages.home',$data);
    }
    public function productview($id)
    {
        $data['title']     =__("Product-View");
        $data['product'] = Product::where('id',$id)->first();
        $data['categories'] = Category::where('id', $id)->first();
        //$data['related_pro'] = Product::where('cat_id', $data['categories']->id)->get();
        return view('frontend.pages.productdetails', $data);

    }
    public function viewcategory($id)
    {
        $data['category'] = Category::where('id', $id)->first();
        if($data['category'])
        {
            $data['title']     =__("View-Category");
            $data['products'] = Product::where('cat_id', $data['category']->id)->get();
            return view('frontend.pages.categorypage', $data);
        }
        else{
            return redirect()->back();
        }
    }
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->first();
        if($coupon){
            $subtotal = Cart::all()->where('ip_address', request()->ip())->sum(
                function($t){
                   return $t->price * $t->product_qnty;
                });
            session()->put('coupon',[
                'coupon_name' =>$coupon->coupon_name,
                'coupon_discount' =>$coupon->coupon_discount,
                'discount_amount' => $subtotal * ($coupon->coupon_discount/100),

            ]);
            return redirect()->back()->with('message', 'Applied Coupon!!');
        }else{
            return redirect()->back()->with('message', 'Invalid Coupon!!');
        }
    }
    public function destroyCoupon()
    {
        if(session()->has('coupon')){
            session()->forget('coupon');
            return redirect()->back()->with('message', 'Deleted Coupon!!');
        }

    }
    public function checkout()
    {
        $data['title'] =__("Checkout");
        $data['carts'] = Cart::with('product')->get();
        return view('frontend.pages.checkout', $data);
    }
}
