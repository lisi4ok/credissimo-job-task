@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
        <h1>Create Product</h1>
        <div class="row">
            {!! Form::open(['files' => true,'action' => route('product.store'),'method' => 'post','id' => 'product-save-form']) !!}

            @include('product._fields')
            <hr />
            @include('product.images')

            <hr />
            @foreach ($attirbutes as $attribute)
                {!! Form::text($attribute->identifier, $attribute->name) !!}
            @endforeach

            {!! Form::submit('Create Product') !!}
            {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('product.index').'"']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection
