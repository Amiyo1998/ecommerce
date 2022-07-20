@extends('frontend.layouts.master')

@section('title')
    {{ $title }}
@endsection
@section('content')
<section class="hero">
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">{{ session('message') }}</div>
        @endif
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul>
                        @foreach ($categories as $category)
                        <li><a href="{{ route('view-category',$category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                <div >
                    @foreach ($bannaer_pro as $product)
                        <div class="set-bg">
                            <img src="{{ asset('storage/'.$product->image)}}" alt="" >
                        </div>
                        <div class="hero__text set_bg_text">
                            <span>FRUIT FRESH</span>
                            <h2>{{ $product->name}} <br />100% Organic</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="{{ route('product-view',$product->id)}}" class="primary-btn">SHOP NOW</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ($categories as $category)
                <div class="col-lg-3">
                    <div class="categories__item set-bg">
                        <img src="{{ asset('storage/'.$category->image)}}" alt="">
                        <h5><a href="{{ route('view-category',$category->id) }}">{{ $category->name}}</a></h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Featured Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @foreach ($categories as $category)
                            <li data-filter=".filter{{ $category->id}}">{{ $category->name}}</li>
                        @endforeach
                        {{-- <li data-filter=".fresh-meat">Fresh Meat</li>
                        <li data-filter=".vegetables">Vegetables</li>
                        <li data-filter=".fastfood">Fastfood</li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @foreach ($categories as $category)
            @php
                $products = App\Models\Product::where('cat_id', $category->id)->latest()->get();
            @endphp
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix filter{{ $category->id }}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" >
                                <img src="{{ asset('storage/'.$product->image)}}" alt="">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li>
                                        <form action="{{ route('carts.store',$product->id)}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <input type="hidden"  name="price" value="{{ $product->seller_price}}">
                                            <input type="number" style="display: none" value="1" name="product_qnty" class="@error('product_qnty') is-invalid @enderror">
                                            <button type="submit" style="border: 1px solid rgb(241, 238, 238); border-radius:50%; width:40px; height:40px; background-color:#fff;"><i class="fa fa-shopping-cart"></i></button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="{{ route('product-view',$product->id)}}">{{ $product->name}}</a></h6>
                                <h5>{{ $product->seller_price}}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset('frontend/img/banner/banner-1.jpg')}}" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset('frontend/img/banner/banner-2.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @foreach ($its_lm as $product)
                            <a href="{{ route('product-view',$product->id)}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('storage/'.$product->image)}}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $product->name }}</h6>
                                    <span>{{ $product->seller_price }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="latest-prdouct__slider__item">
                            @foreach ($its_lm as $product)
                            <a href="{{ route('product-view',$product->id)}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('storage/'.$product->image)}}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $product->name }}</h6>
                                    <span>{{ $product->seller_price }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Top Rated Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @foreach ($its_lm as $product)
                            <a href="{{ route('product-view',$product->id)}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('storage/'.$product->image)}}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $product->name }}</h6>
                                    <span>{{ $product->seller_price }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="latest-prdouct__slider__item">
                            @foreach ($its_lm as $product)
                            <a href="{{ route('product-view',$product->id)}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('storage/'.$product->image)}}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $product->name }}</h6>
                                    <span>{{ $product->seller_price }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Review Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @foreach ($its_lm as $product)
                            <a href="{{ route('product-view',$product->id)}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('storage/'.$product->image)}}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $product->name }}</h6>
                                    <span>{{ $product->seller_price }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="latest-prdouct__slider__item">
                            @foreach ($its_lm as $product)
                            <a href="{{ route('product-view',$product->id)}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{ asset('storage/'.$product->image)}}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{ $product->name }}</h6>
                                    <span>{{ $product->seller_price }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->

<!-- Blog Section Begin -->
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>From The Blog</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{ asset('frontend/img/blog/blog-1.jpg')}}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Cooking tips make cooking simple</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{ asset('frontend/img/blog/blog-2.jpg')}}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{ asset('frontend/img/blog/blog-3.jpg')}}" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#">Visit the clean farm in the US</a></h5>
                        <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
