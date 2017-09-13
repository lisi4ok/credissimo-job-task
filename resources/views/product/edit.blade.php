@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
        <h1>Edit Product</h1>
        <div class="row">
        {!! Form::bind($product, ['files' => true,'method' => 'PUT', 'action' => route('product.update', $product->id),'id' => 'product-save-form' ]) !!}
            @php
                $productCategories = $product->categories()
                ->get()->pluck('id')->toArray();
            @endphp
            @include('product._fields')
            <hr />
            @include('product.images')

            <hr />
            @foreach ($attributes as $attribute)
                <div class="form-group">
                    <label for="{{ $attribute->identifier }}">{{ $attribute->name }}</label>
                    <input type="text" class="form-control" name="{{ $attribute->identifier }}" id="{{ $attribute->identifier }}" placeholder="{{ $attribute->name }}" value="{{ $attribute->value }}">
                </div>
            @endforeach

            {!! Form::submit('Edit Product') !!}
            {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('product.index').'"']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection
