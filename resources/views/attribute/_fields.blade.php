{!! Form::text('name','Name') !!}
{!! Form::text('identifier','Identifier') !!}

@if (0)
{!! Form::select('field_type','Field Type',['' => 'Please Select','TEXT' => 'Text','TEXTAREA' => 'Text Area','SELECT' => 'Dropdown'] ) !!}
@endif
{!! Form::select('field_type','Field Type',['' => 'Please Select','TEXT' => 'Text'] ) !!}

{!! Form::text('sort_order','Sort Order') !!}
