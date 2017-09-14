{!! Form::text('name','Name') !!}
{!! Form::text('identifier','Identifier') !!}
{!! Form::select('field_type', 'Field Type', [
	'' => 'Please Select',
	'TEXT' => 'Text',
	'TEXTAREA' => 'Text Area',
	'SELECT' => 'Dropdown',
]) !!}
@include('attribute.option')
{!! Form::text('sort_order','Sort Order') !!}
