@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        <div class="panel-heading"><h1>Create Product</h1></div>
        <div class="panel-body">
        {!! Form::open(['files' => true,'action' => route('product.store'),'method' => 'post','id' => 'product-save-form']) !!}
        @include('product._fields')
        <hr />
        @include('product.images')
        <hr />
        @include('product.attributes')
        {!! Form::submit('Create Product') !!}
        {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('product.index').'"']) !!}
        {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>
@endsection
