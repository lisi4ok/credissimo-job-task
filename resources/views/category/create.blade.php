@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8">
        <h1>Create Category</h1>
            {!! Form::open(['method' => 'post', 'action' => route('category.store')]) !!}

                @include('category._fields')
                {!! Form::submit('Create Category',['disabled' => true, 'class' => 'btn category-save-button']) !!}
                    <a href="{{ route('category.index') }}" class="btn ">Cancel</a>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
