@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        <div class="panel-heading"><h1>Edit Category</h1></div>
        <div class="panel-body">
            {!! Form::bind($category , ['method' => 'put', 'action' => route('category.update', $category->id)]) !!}
                @include('category.fields')
                {!! Form::submit('Edit Category', ['disabled' => true, 'class' => 'btn category-save-button']) !!}
                <a href="{{ route('category.index') }}" class="btn btn-default">Cancel</a>
            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>
@endsection
