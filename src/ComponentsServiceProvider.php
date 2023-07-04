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
        $this->loadViewsFrom(__DIR__.'/views', 'tallcomponents');
        Blade::component('tallcomponents::components/input', 'input');
        Blade::component('tallcomponents::components/breadcrumbs', 'breadcrumbs');
        Blade::component('tallcomponents::components/avatar', 'avatar');
        Blade::component('tallcomponents::components/accordion', 'accordion');
        Blade::component('tallcomponents::components/alert', 'alert');
        Blade::component('tallcomponents::components/button', 'button');
        Blade::component('tallcomponents::components/dialog', 'dialog');
        Blade::component('tallcomponents::components/tooltip', 'tooltip');
        Blade::component('tallcomponents::components/card', 'card');
        Blade::component('tallcomponents::components/dropdown', 'dropdown');
        Blade::component('tallcomponents::components/popover', 'popover');
        Blade::component('tallcomponents::components/progressbar', 'progressbar');
        Blade::component('tallcomponents::components/toast', 'toast');
        Blade::component('tallcomponents::components/chip', 'chip');
        Blade::component('tallcomponents::components/spinner', 'spinner');
        Blade::component('tallcomponents::components/carousel', 'carousel');
        Blade::component('tallcomponents::components/navbar', 'navbar');
        Blade::component('tallcomponents::components/tabs', 'tabs');
        Blade::component('tallcomponents::components/validation', 'validation');
        Blade::component('tallcomponents::components/typography', 'typography');
        
        $this->publishes([
            __DIR__.'/views/components/pagination.blade.php' => resource_path('views/vendor/tallcomponents/pagination.blade.php'),
        ], 'tallcomponents:pagination');
    }
}
