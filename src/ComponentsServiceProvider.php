<?php

namespace ct_taco\tall;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ComponentsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'ct-taco');
        Blade::component('ct-taco::tall/input', 'input');
        Blade::component('ct-taco::tall/breadcrumbs', 'breadcrumbs');
        Blade::component('ct-taco::tall/avatar', 'avatar');
        Blade::component('ct-taco::tall/accordion', 'accordion');
        Blade::component('ct-taco::tall/alert', 'alert');
        Blade::component('ct-taco::tall/button', 'button');
        Blade::component('ct-taco::tall/dialog', 'dialog');
        Blade::component('ct-taco::tall/tooltip', 'tooltip');
        Blade::component('ct-taco::tall/card', 'card');
        Blade::component('ct-taco::tall/dropdown', 'dropdown');
        Blade::component('ct-taco::tall/popover', 'popover');
        Blade::component('ct-taco::tall/progressbar', 'progressbar');
        Blade::component('ct-taco::tall/toast', 'toast');
        Blade::component('ct-taco::tall/chip', 'chip');
        Blade::component('ct-taco::tall/spinner', 'spinner');
        Blade::component('ct-taco::tall/carousel', 'carousel');
        Blade::component('ct-taco::tall/navbar', 'navbar');
        Blade::component('ct-taco::tall/tabs', 'tabs');
        Blade::component('ct-taco::tall/validation', 'validation');
        Blade::component('ct-taco::tall/typography', 'typography');
        
        $this->publishes([
            __DIR__.'/views/tall/pagination.blade.php' => resource_path('views/vendor/ct-taco/tall/pagination.blade.php'),
        ], 'ct-taco::tall/pagination');
    }
}
