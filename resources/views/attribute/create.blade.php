@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <h1>
                Create Product Attribute
            </h1>
            {!! Form::open(['method' => 'post','action' => route('attribute.store')]) !!}
            @include('attribute._fields')
            {!! Form::submit('Create Attribute') !!}
            {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('attribute.index').'"']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
