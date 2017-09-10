@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="h1">
            Categories
            <a style="" href="{{ route('category.create') }}" class="btn btn-primary float-right">
            	Create
            </a>
        </div>
    </div>
@stop
