<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Framework\Image\LocalImageFile;
use App\Models\Category;
use App\Models\ProductCollection;
use App\Models\ProductImage;
//use App\Models\ProductAttribute;
//use App\Models\ProductPrice;

class Product extends Model
{
    protected $fillable = [
    	'name', 'slug', 'sku', 'description', 'price',
        //'status', 'in_stock', 'track_stock', 'qty',
    ];

    public static function getCollection()
    {
        $products = Product::all();
        $productCollection = new ProductCollection();
        $productCollection->setCollection($products);
        return $productCollection;
    }

    public static function boot()
    {
        parent::boot();
        // registering a callback
        // to be executed upon the creation of an activity AR
        static::creating(function($model) {

            // produce a slug based on the activity title
            $slug = Str::slug($model->name);

            // check to see if any other slugs
            // exist that are the same & count them
            $count = static::whereRaw(
            	"slug RLIKE '^{$slug}(-[0-9]+)?$'"
            )->count();

            // if other slugs exist that are the same,
            // append the count to the slug
            $model->slug = $count ? "{$slug}-{$count}" : $slug;

        });
    }

    /**
     * Return Product model by Product Slug
     *
     * @param $slug
     * return \App\Models\Product $product
     */
    public static function getProductBySlug($slug)
    {
        $model = new static;
        return $model->where('slug', '=', $slug)->first();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // public function prices()
    // {
    //     return $this->hasMany(ProductPrice::class);
    // }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productAttributeValues() {
        return $this->hasMany(ProductAttributeValue::class);
    }

    /**
     * return default Image or LocalImageFile Object
     *
     * @return string | \App\Framework\Image\LocalImageFile
     */
    public function getImageAttribute()
    {
        $defaultPath = "/img/default-product.jpg";
        $image = $this->images()->where('is_main_image','=',1)->first();


        if (null === $image) {
            return new LocalImageFile($defaultPath);
        }

        if ($image->path instanceof LocalImageFile) {
            return $image->path;
        }
    }

    /*
     * Get the Price for the Product
     *
     * @return float $value
     */
    // public function getPriceAttribute()
    // {
    //     $row = $this->prices()->first();
    //     return (isset($row->price)) ? $row->price : null;
    // }
}
