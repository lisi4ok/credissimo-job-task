
{!! Form::text('name','Product Name') !!}

{!! Form::text('slug','Product Slug') !!}

    @if(!isset($productCategories))
	    @php
	    	$productCategories = [];
	    @endphp
    @endif
    {!! Form::select("category_id[]", "Category", $categoryOptions,
        ['class' => 'form-control select2',
        'multiple' => 'true',
        'value' => $productCategories
        ]
    ) !!}

{!! Form::text('sku', 'SKU') !!}

{!! Form::text('price','Price') !!}

{!! Form::textarea('description', 'Description',['class' => 'ckeditor']) !!}

@push('scripts')
<script>
jQuery(document).ready(function() {
   	jQuery('.select2').select2();
});
</script>
@endpush
