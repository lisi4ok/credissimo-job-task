<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Cache;

class Model extends Eloquent
{
    public static function findorfail($id, array $columns = array('*'))
    {
        $model = new static();
        try {
            $row = call_user_func_array([static::query(), 'findorfail'], [$id, $columns]);
            return $row;
        } catch (ModelNotFoundException $e) {
            throw with(new TenantModelNotFoundException())->setModel(get_called_class());
        }
    }

    public static function paginate($perPage = null,
                                    array $columns = array('*'),
                                    $pageName = 'page',
                                    $page = null)
    {
        $model = new static();
        $rows = call_user_func_array([static::query(), 'paginate'], [$perPage , $columns, $pageName , $page]);

        return $rows;

    }

    public static function create(array $attributes = [])
    {

        $row = call_user_func_array([static::query(), 'create'], [$attributes]);

        return $row;
    }


    public function update(array $attributes = [], array $options = [])
    {
        return parent::update($attributes, $options);
    }


    public function delete()
    {
        return parent::delete();
    }

    public function forgetCommonQueryCache() {

    }
}
