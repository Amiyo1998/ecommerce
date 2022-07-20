@extends('backend.layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('content')
<div class="container">
    <div class="row card-header">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('categories.index')}}">{{ $title }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mx-auto pt-5">
            <form action="{{ route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
               @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $product->name}}">
                    @error('name')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="slug">{{ __("Category name")}}</label>
                    <div class="col-sm-9 form-control">
                        <select name="cat_id" id="cat_id" class="form-control-plaintext ">
                            <option value="{{ $product->cat_id}}" class="@error('cat_id') is-invalid @enderror ">{{ $product->category->name}}</option>
                        </select>
                        @error('cat_id')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="slug">Slug Name:</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ $product->slug}}">
                    @error('slug')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="small_description">Small Description</label>
                    <input type="text" class="form-control @error('small_description') is-invalid @enderror" name="small_description" id="small_description" value="{{ $product->small_description}}">
                    @error('small_description')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" value="{{ $product->description}}">
                    @error('description')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="orginal_price">Orginal Price</label>
                    <input type="text" class="form-control @error('orginal_price') is-invalid @enderror" name="orginal_price" id="orginal_price" value="{{ $product->orginal_price}}">
                    @error('orginal_price')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="seller_price">Seller Price</label>
                    <input type="text" class="form-control @error('seller_price') is-invalid @enderror" name="seller_price" id="seller_price" value="{{ $product->seller_price}}">
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" >
                    <img src="{{ asset('storage/'.$product->image) }}" alt="" width="80px" height="50px">
                    @error('image')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="qty">Quantity:</label>
                    <input type="text" class="form-control @error('qty') is-invalid @enderror" name="qty" id="qty" value="{{ $product->qty}}">
                    @error('qty')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tax">Tax:</label>
                    <input type="text" class="form-control @error('tax') is-invalid @enderror" name="tax" id="tax" value="{{ $product->tax}}">
                    @error('tax')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="keyword">Keyword Name:</label>
                    <input type="text" class="form-control @error('keyword') is-invalid @enderror" name="keyword" id="keyword" value="{{ $product->keyword}}">
                    @error('keyword')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>
                <button type="submit" class="btn  btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
