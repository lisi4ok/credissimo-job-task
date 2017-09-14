@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        <div class="panel-heading"><h1>Create Category</h1></div>
        <div class="panel-body">
            {!! Form::open(['method' => 'post', 'action' => route('category.store')]) !!}
                @include('category._fields')
                {!! Form::submit('Create Category',['disabled' => true, 'class' => 'btn category-save-button']) !!}
                    <a href="{{ route('category.index') }}" class="btn ">Cancel</a>
            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>
@endsection
