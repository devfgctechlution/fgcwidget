<?php

namespace FGCQuickWeb\Widgets\Commands;

/**
 * Description of CommandServiceProvider
 *
 * @author Hoang Bien<hoangbien264@gmail.com>
 * @copyright (c) 2022, Fgc Techlution, JSC
 */
use Illuminate\Support\ServiceProvider;
use FGCQuickWeb\Widgets\Commands\WidgetMakeCommand;

class CommandServiceProvider extends ServiceProvider {

    protected $commands = [
        WidgetMakeCommand::class,
    ];

    public function register() {
        $this->commands($this->commands);
    }

    public function boot() {
        
    }

}
