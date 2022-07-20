@extends('frontend.layouts.master')

@section('title')
    {{ $title }}
@endsection
@section('content')
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">{{ session('message') }}</div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ asset('storage/'.$cart->product->image)}}" alt="" style="width: 60px">
                                        <h5>{{$cart->product->name}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{$cart->product->seller_price}}
                                    </td>
                                    <form action="{{ route('carts.update',$cart->id)}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" name="product_qnty" value="{{ $cart->product_qnty }}">
                                                </div>
                                                <button type="submit" class="btn btn-primary fs-4 fw-bold text-light px-2 py-1" >Update</i></button>
                                            </div>
                                        </td>
                                    </form>
                                    <td class="shoping__cart__total">
                                        ${{ $cart->product_qnty * $cart->price}}
                                    </td>
                                    <form action="{{ route('carts.destroy',$cart->id)}}" method="POST">
                                        <td class="shoping__cart__item__close">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger fs-4 fw-bold text-light px-2 py-1" onclick="return confirm('Are you sure to delete?');">Delete</i></button>
                                        </td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('home')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    @if (session()->has('coupon'))
                    @else
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="{{ route('apply-coupon')}}" method="POST">
                                @csrf
                                <input type="text" name="coupon_name" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            @if (session()->has('coupon'))
                            <li>Subtotal <span>${{ $subtotal }}</span></li>
                            <li>Coupon <span style="text-transform: uppercase;">{{ session()->get('coupon')['coupon_name'] }} <a href="{{ route('apply-destroy')}}" >x</a> </span></li>
                            <li>Discount <span>{{ session()->get('coupon')['coupon_discount'] }}%(${{ session()->get('coupon')['discount_amount'] }})</span></li>
                            <li>Total <span>${{ $subtotal - session()->get('coupon')['discount_amount']}}</span></li>
                            @else
                            <li>Total <span>${{ $subtotal }}</span></li>
                            @endif
                        </ul>
                        <a href="{{ route('checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
