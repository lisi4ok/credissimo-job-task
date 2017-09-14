{!! Form::text('name','Category Name') !!}
{!! Form::text('slug','Category Slug') !!}
{!! Form::select('parent_id','Parent Category', $categoryOptions) !!}
@push('scripts')
<script>
    jQuery(function() {
        var field1Selector = "#name";
        var field2Selector = "#slug";
        var buttonSelector = ".category-save-button";
        function checkFields() {
            var field1Value = jQuery(field1Selector).val();
            var field2Value= jQuery(field2Selector).val();
            if(field1Value != "" && field2Value  != "") {
                jQuery(buttonSelector).attr('disabled', false);
                jQuery(buttonSelector).addClass('btn-primary');
            } else {
                jQuery(buttonSelector).attr('disabled', true);
                jQuery(buttonSelector).removeClass('btn-primary');
            }
        }
        jQuery(document).on('keyup', '#name , #slug', function(e){
            checkFields();
        });
        jQuery(document).on('change', '#name, #slug', function(e){
            checkFields();
        });
        checkFields();
    });
</script>
@endpush
