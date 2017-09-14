@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        <div class="panel-heading"><h1>Create Product Attribute</h1></div>
        <div class="panel-body">
            {!! Form::open(['method' => 'post','action' => route('attribute.store')]) !!}
            @include('attribute._fields')
            {!! Form::submit('Create Attribute') !!}
            {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('attribute.index').'"']) !!}
            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>
@endsection
