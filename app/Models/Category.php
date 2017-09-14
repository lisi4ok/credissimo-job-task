<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Support\Collection;

class Category extends Model
{
    protected $fillable = ['parent_id', 'name', 'slug'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public static function getCategoryOptions()
    {
        $model = new static;
        $options = Collection::make(
            ['' => 'Please Select'] + $model->all()->pluck('name', 'id')->toArray()
        );
        return $options;
    }

    public function getParentNameAttribute()
    {
        $parentCategory = $this->where(
            'id', '=', $this->attributes['parent_id']
        )->get()->first();
        return (null != $parentCategory) ? $parentCategory->name : '';
    }

    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getAllCategories()
    {
        $data = [];
        $rootCategories = $this->where('parent_id', '=', '0')->get();
        $data = $this->listCategories($rootCategories);
        return $data;
    }

    public function listCategories($categories)
    {
        $data = [];
        foreach ($categories as $category) {
            $data[] = [
                'object' => $category,
                'children' => $this->listCategories($category->children),
            ];
        }
        return $data;
    }

    public function getChilds($id)
    {
        return $this->where('parent_id', '=', $id)->get();
    }
}
