<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Event;

use App\ViewComposers\CategoryTreeComposer;
use App\ViewComposers\CategoryFieldsComposer;
use App\ViewComposers\ProductFieldsComposer;
use App\ViewComposers\ProductAttributesComposer;

use App\Events\AttributeSavedEvent;
use App\Listeners\AttributeSavingListener;

use App\Events\ProductSavedEvent;
use App\Listeners\ProductCategorySavingListener;
use App\Listeners\ProductAttributeSavingListener;
use App\Listeners\ProductSavingListener;

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
            ['layouts.app'],
            CategoryTreeComposer::class
        );
        View::composer(
            ['category.fields'],
            CategoryFieldsComposer::class
        );
        View::composer(
            ['product.fields'],
            ProductFieldsComposer::class
        );
        View::composer(
            ['product.attributes'],
            ProductAttributesComposer::class
        );

        Event::listen(
            AttributeSavedEvent::class,
            AttributeSavingListener::class
        );
        Event::listen(
            ProductSavedEvent::class,
            ProductCategorySavingListener::class
        );
        Event::listen(
            ProductSavedEvent::class,
            ProductAttributeSavingListener::class
        );
        Event::listen(
            ProductSavedEvent::class,
            ProductSavingListener::class
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
