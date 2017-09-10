@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">Create Category</div>
                <div class="card-body">

                    {!! Form::open(['method' => 'post', 'action' => 'CategoryController@store']) !!}

                        @include('category._fields')
                        {!! Form::submit('Create Category',['disabled' => true, 'class' => 'btn category-save-button']) !!}
                            <a href="{{ route('category.index') }}" class="btn ">Cancel</a>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection
