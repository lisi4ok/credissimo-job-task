@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Edit Category</div>
                <div class="card-body">

                    {!! Form::bind($category , ['method' => 'put', 'action' => route('category.update', $category->id)]) !!}

                    @include('category._fields')

                    {!! Form::submit('Edit Category', ['disabled' => true, 'class' => 'btn category-save-button']) !!}
                    <a href="{{ route('category.index') }}" class="btn btn-default">Cancel</a>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection
