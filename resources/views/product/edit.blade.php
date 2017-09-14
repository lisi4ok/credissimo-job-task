@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        <div class="panel-heading"><h1>Edit Product</h1></div>
        <div class="panel-body">
        {!! Form::bind($product, ['files' => true,'method' => 'PUT', 'action' => route('product.update', $product->id),'id' => 'product-save-form' ]) !!}
            @php
                $productCategories = $product->categories()
                ->get()->pluck('id')->toArray();
            @endphp
            @include('product.fields')
            <hr />
            @include('product.images')
            <hr />
            @include('product.attributes')
            {!! Form::submit('Edit Product') !!}
            {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('product.index').'"']) !!}
            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>
@endsection
