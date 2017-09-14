@php
if (isset($attribute) && $attribute->attributeDropdownOptions->count() > 0) {
    $edit = true;
    $class = '';
} else {
    $randomString = substr(str_shuffle(
        str_repeat('abcdefghijklmnopqrstuvwxyz', 6)
    ), 0, 6);
    $class = 'hidden';
    $edit = false;
}
@endphp
<div class="dynamic-field {{ $class }}">
	@if($edit === true)
		@foreach($attribute->attributeDropdownOptions as $dropdownOption)
		    <div class="dynamic-field-row">
		        <div class="form-group col-md-12">
		            <label>Display Text</label>
		            <span class="input-group">
		                <input class="form-control"
		                       name="dropdown-options[{{ $dropdownOption->id }}][display_text]"
		                       value="{{ $dropdownOption->display_text }}" />
                        @if ($loop->last)
                            <span class="input-group-addon add-field" style="cursor: pointer;">Add</span>
                        @else
                            <span class="input-group-addon remove-field" style="cursor: pointer;">Remove</span>
                        @endif
		            </span>
		        </div>
		    </div>
		@endforeach
	@else
    <div class="dynamic-field-row">
        <div class="form-group col-md-12">
            <label>Display Text</label>
            <span class="input-group">
                <input disabled class="form-control"
                       name="dropdown-options[{{ $randomString }}][display_text]"/>
                <span class="input-group-addon add-field"
                      style="cursor: pointer;">Add</span>
            </span>
        </div>
    </div>
    @endif
    <div class="dynamic-field-row-template hidden">
        <div class="dynamic-field-row">
            <div class="form-group col-md-12">
                <label>Display Text</label>
                <span class="input-group">
                    <input class="form-control"
                           name="dropdown-options[__RANDOM_STRING__][display_text]"/>
                    <span class="input-group-addon add-field"
                          style="cursor: pointer;">Add</span>
                </span>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    jQuery(document).ready(function () {
        jQuery(document).on('click', '.add-field', function (e) {
            e.preventDefault();
            var rowTemplate = jQuery('.dynamic-field-row-template').html();
            var randomString = "";
            var possible = "abcdefghijklmnopqrstuvwxyz0123456789";
            for (var i = 0; i < 5; i++) {
                randomString += possible.charAt(Math.floor(Math.random() * possible.length));
            }
            rowTemplate = rowTemplate.replace("__RANDOM_STRING__", randomString);
            jQuery(e.target).html('Remove');
            jQuery(e.target).removeClass('add-field');
            jQuery(e.target).addClass('remove-field');
            jQuery(e.target).parents('.dynamic-field-row:first').after(rowTemplate);
        });
        jQuery(document).on('click', '.remove-field', function (e) {
            e.preventDefault();
            jQuery(e.target).parents('.dynamic-field-row:first').remove();
        })
        jQuery('#field_type').on('change', function (e) {
            jQuery('.dynamic-field input').attr('disabled', true);
            jQuery('.dynamic-field').addClass('hidden');
            jQuery('.validate_field').val('');
            jQuery('.validate_field').trigger('change.select2');
            if (jQuery(e.target).val() == "TEXT") {
                jQuery('.validate_field').val('max:255');
                jQuery('.validate_field').trigger('change.select2');
            }
            if (jQuery(e.target).val() == "SELECT" && jQuery('.dynamic-field').hasClass('hidden')) {
                jQuery('.dynamic-field').removeClass('hidden');
                jQuery('.dynamic-field input').attr('disabled', false);
            }
        })
    });
</script>
@endpush
