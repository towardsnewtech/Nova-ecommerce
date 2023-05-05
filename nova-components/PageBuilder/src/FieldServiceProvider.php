<?php

namespace Gtrig\PageBuilder;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
			__DIR__.'/../resources/fonts' => public_path('/fonts'),
		], 'public');
        
        Nova::serving(function (ServingNova $event) {
            Nova::script('page-builder', __DIR__.'/../dist/js/field.js');
            Nova::style('page-builder', __DIR__.'/../dist/css/field.css');
        });
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
