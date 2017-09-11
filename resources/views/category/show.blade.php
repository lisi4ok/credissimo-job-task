@extends('layouts.app')
@section('content')
<h1>{{ $category->name }}</h1>
<div class="row">
    @if(count($category->products) <= 0)
        <p>Sorry No Products Found</p>
    @else
        <ul class="cd-gallery">
            @foreach($products as $product)
            <li>
                <a href="{{ route('product.show', $product->slug) }}">
                    <ul class="cd-item-wrapper">
                        <li class="selected">
                            <img src="assets/images/shop/ugmonk-tshirt-1.jpg" alt="Preview image">
                        </li>
                        <li class="move-right" data-sale="true" data-price="$22">
                            <img src="assets/images/shop/ugmonk-tshirt-2.jpg" alt="Preview image">
                        </li>
                        <li>
                            <img src="assets/images/shop/ugmonk-tshirt-3.jpg" alt="Preview image">
                        </li>
                    </ul>
                </a>
                <div class="cd-item-info">
                    <b><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></b>
                    <em class="cd-price">$ {{ number_format($product->price, 2, '.', '') }}</em>
                </div>
                <div class="cd-item-details">
                    <a href="#" class="pull-left add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    <a href="{{ route('product.show', $product->slug) }}" class="pull-right details">
                        <i class="fa fa-list-ul"></i>Details
                    </a>
                </div>
            </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
