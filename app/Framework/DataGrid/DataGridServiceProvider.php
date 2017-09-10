<?php

namespace App\Framework\DataGrid;

use Illuminate\Support\ServiceProvider;
use App\Framework\DataGrid\DataGridManager;

class DataGridServiceProvider extends ServiceProvider {

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
    public function register() {

        $this->registerDataGrid();
        $this->app->alias('datagrid', 'App\Framework\DataGrid\DataGridManager');
    }

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerDataGrid() {
        $this->app->singleton('datagrid', function ($app) {

            $request  = $app->request;
            return new DataGridManager($request);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [ 'datagrid', 'App\Framework\DataGrid\DataGridManager'];
    }
}
