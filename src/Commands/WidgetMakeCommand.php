<?php

namespace FGCQuickWeb\Widgets\Commands;

use Illuminate\Console\Command;

class WidgetMakeCommand extends Command {

    //@Todo Code here
    protected $signature = 'fgc-quickweb:make-widget';
    protected $description = 'Initialize a basic widget for quickweb';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        // Logic của command
        $this->info('Widget initialization successful!');
    }

}
