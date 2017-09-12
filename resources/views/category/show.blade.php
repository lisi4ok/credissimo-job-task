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
                    @foreach ($product->images as $image)
                    @if ($image->is_main_image)
                        <img src="{!! $image->path->smallUrl !!}" alt="Preview image">
                        @php
                            break;
                        @endphp
                    @endif
                    @endforeach
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
