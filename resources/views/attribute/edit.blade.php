@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        <div class="panel-heading"><h1>Edit Product Attribute</h1></div>
        <div class="panel-body">
            {!! Form::bind($attribute, ['method' => 'PUT', 'action' => route('attribute.update', $attribute->id)]) !!}
            @include('attribute._fields')
            {!! Form::submit('Update Attribute') !!}
            {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('attribute.index').'"']) !!}
            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>
@endsection
