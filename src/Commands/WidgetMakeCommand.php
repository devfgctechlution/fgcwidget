<?php

namespace FGCQuickWeb\Widgets\Commands;

/**
 * Description of FgcWidgetGenerator
 *
 * @author Hoang Bien<hoangbien264@gmail.com>
 * @copyright (c) 2024, Fgc Techlution, JSC
 */
use Illuminate\Console\Command;

class WidgetMakeCommand extends Command {

    //@Todo Code here
    protected $signature = 'fgc-quickweb:make-widget {nameWidget} {--paramas=""}';
    protected $description = 'Initialize a basic widget for quickweb';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        // Logic của command
        $nameWidget = $this->argument('nameWidget');
        $params = $this->option('paramas');
        $this->info('Widget initialization successful!');
    }

}
