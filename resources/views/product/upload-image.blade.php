<div class="image-preview">
    <div class="actual-image-thumbnail">
        <img class="img-thumbnail img-tag img-responsive" src="{{ $image->smallUrl }}"/>
        <input type="hidden" name="image[{{ $tmp }}][path]" value="{{ $image->relativePath }}"/>
        <input type="hidden" class="is_main_image_hidden_field" name="image[{{ $tmp }}][is_main_image]" value="0"/>
    </div>
    <div class="image-info">
        <div class="actions">
            <div class="action-buttons pull-right">
                <button type="button"
                        class="btn is_main_image_button  selected-icon btn-xs btn-default"
                        title="Select as Main Image">
                    <i class="fa fa-check"></i>
                </button>
                <button type="button" class="destroy-image btn btn-xs btn-default" title="Remove file" >
                    <i class="fa fa-trash-o text-danger"></i>
                </button>
            </div>
        </div>
    </div>
</div>
