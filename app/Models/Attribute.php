<?php
namespace App\Models;

class Attribute extends Model
{

    protected $fillable = ['type', 'name', 'identifier', 'field_type', 'sort_order'];

    public function attributeDropdownOptions() {
        return $this->hasMany(AttributeDropdownOption::class);
    }

}
