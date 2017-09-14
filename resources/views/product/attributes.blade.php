@foreach($attributes as $attribute)
    @if($attribute->field_type == "SELECT")
	    @php
	        $varcharValue = null;
	        if (isset($product) && $product->id > 0) {
	            $productAttributeValues = $attribute->productAttributeValues()->where('product_id', '=', $product->id)->first();
	            $varcharValue = (isset($productAttributeValues->value)) ? $productAttributeValues->value : NULL;
	        }
	    @endphp
	    {!! Form::select('modules[attributes]['.$attribute->identifier.']',
            $attribute->name,
            $attribute->attributeDropdownOptions->pluck('display_text','id'),
            ['value' => $varcharValue,'class' => 'form-control']
	    ) !!}
    @endif
    @if($attribute->field_type == "TEXT")
		@php
            $varcharValue = null;
            if (isset($product) && $product->id > 0) {
                $productAttributeValue = $attribute->productAttributeValues()
                	->where('product_id', '=', $product->id)->first();
                $varcharValue = (isset($productAttributeValue->value)) ? $productAttributeValue->value : NULL;
            }
		@endphp
        {!! Form::text('modules[attributes]['.$attribute->identifier.']',
            $attribute->name,
            ['value' => $varcharValue, 'class' => 'form-control']
        ) !!}
    @endif
@endforeach
