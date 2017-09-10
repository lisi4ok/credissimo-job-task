<?php
namespace App\Framework\Image;

use App\Framework\Image\ImageService;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPayment();

        $this->app->alias('image', 'App\Framework\Image\ImageService');
    }
    /**
     * Register the AdmainConfiguration instance.
     *
     * @return void
     */
    protected function registerPayment()
    {
        $this->app->singleton('image', function ($app) {
            return new ImageService();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['image', 'App\Framework\Image\ImageService'];
    }
}
