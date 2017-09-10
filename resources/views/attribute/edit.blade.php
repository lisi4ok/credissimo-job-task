@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <h1>Edit Attribute</h1>
            {!! Form::bind($attribute, ['method' => 'PUT', 'action' => route('attribute.update', $attribute->id)]) !!}

            @include('attribute._fields')

            {!! Form::submit('Update Attribute') !!}
            {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('attribute.index').'"']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection
