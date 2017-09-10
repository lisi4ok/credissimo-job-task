<?php

namespace App\Models;

class AttributeDropdownOption extends Model
{
    protected $fillable = ['attribute_id', 'display_text'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}

