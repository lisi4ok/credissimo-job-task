<?php

namespace App\Framework\Attribute;

use Illuminate\Support\ServiceProvider;
use App\Framework\Attribute\AttributeCollection;

class AttributeServiceProvider extends ServiceProvider
{

    protected $defer = true;


    public function register() {
        $this->registerAttributes();
        $this->app->alias('attributes', 'App\Framework\Attribute\AttributeCollection');


    }

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerAttributes()
    {
        $this->app->singleton('attributes', function ($app) {
            return new AttributeCollection();
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ 'attributes',  'App\Framework\Attribute\AttributeCollection'];
    }
}
