<?php
namespace App\Framework\Attribute;


use Illuminate\Support\Collection;
use App\Framework\Attribute\Type\Select;

class AttributeCollection {

    public $attributes = NULL;


    public function __construct() {
        $this->attributes = Collection::make([]);
    }


    public function type($type) {


        return $this;

    }
    public function add($key) {
        $this->attributes->put($key, []);

        return $this;
    }


    public function select($type) {
        $select = new Select();
        $select->type($type);
        $this->attributes->push($select);

        return $select;
    }
    public function all($type) {

        $attributes = $this->attributes->filter(function ($item, $key) use ($type) {

            if($item->get('type') == $type) {
                return true;
            }
        });

        return $attributes;
    }
}
