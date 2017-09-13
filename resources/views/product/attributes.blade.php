@foreach ($attirbutes as $attribute)
    {!! Form::text($attribute->identifier, $attribute->name) !!}
@endforeach
