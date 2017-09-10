@extends('layouts.app')

@section('content')
    <h1>
        <span>Attributes</span>
        <a style="" href="{{ route('attribute.create') }}" class="btn btn-primary float-right">Create
            Attribute</a>
    </h1>

    {!! $dataGrid->render() !!}

@stop
