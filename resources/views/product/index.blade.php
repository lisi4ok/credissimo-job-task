@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>
            <span>Products</span>
            <a style="" href="{{ route('product.create') }}" class="btn btn-primary float-right">
                Create Product
            </a>
        </h1>
        {!! $dataGrid->render() !!}
    </div>
@stop
