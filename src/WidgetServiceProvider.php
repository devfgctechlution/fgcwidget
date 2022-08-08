<?php
namespace FGCQuickWeb\Widgets;

use Illuminate\Support\ServiceProvider;

class WidgetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadCoreWidget();
    }
    private function loadCoreWidget()
    {
        $path_widget_function = __DIR__.'/helpers.php';
        if (file_exists($path_widget_function)){
            require_once($path_widget_function);
            fgc_auto_load_widgets();
        }
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
