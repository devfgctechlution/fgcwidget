<?php
namespace FGCQuickWeb\Widgets;

use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load_core_widget($this->app);
    }
    private function load_core_widget($app)
    {
        $pathWidgetFunction = __DIR__.'/helpers.php';
        if (file_exists($pathWidgetFunction))
            require_once($pathWidgetFunction);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
