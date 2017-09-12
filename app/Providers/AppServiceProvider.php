<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event;
use App\ViewComposers\CategoryFieldsComposer;
use App\ViewComposers\ProductFieldsComposer;
use App\Events\ProductSavedEvent;
use App\Listeners\ProductCategorySavingListener;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['category._fields'],
            CategoryFieldsComposer::class
        );
        View::composer(
            ['product._fields'],
            ProductFieldsComposer::class
        );

        Event::listen(
            ProductSavedEvent::class,
            ProductCategorySavingListener::class
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
