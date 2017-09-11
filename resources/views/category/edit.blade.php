@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>Edit Category</h1>
            {!! Form::bind($category , ['method' => 'put', 'action' => route('category.update', $category->id)]) !!}

            @include('category._fields')

            {!! Form::submit('Edit Category', ['disabled' => true, 'class' => 'btn category-save-button']) !!}
            <a href="{{ route('category.index') }}" class="btn btn-default">Cancel</a>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
