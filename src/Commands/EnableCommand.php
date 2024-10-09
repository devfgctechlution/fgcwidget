<?php
namespace FGCQuickWeb\Widgets\Commands;

/**
 * Description of EnableCommand
 *
 * @author Hoang Bien<hoangbien264@gmail.com>
 * @copyright (c) 2024, Fgc Techlution, JSC
 */
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
class EnableCommand extends Command {
     /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'widget:enable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable the specified widget.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {

        $this->components->info('Enabling widget ...');

        if ($name = $this->argument('widget') ) {
            $this->enable($name);

            return 0;
        }

        $this->enableAll();

        return 0;
    }

    /**
     * enableAll
     *
     * @return void
     */
    public function enableAll()
    {
        /** @var Widgets $widgets */
        $widgets = $this->laravel['widget']->all();

        foreach ($widgets as $widget) {
            $this->enable($widget);
        }
    }

    /**
     * enable
     *
     * @param string $name
     * @return void
     */
    public function enable($name)
    {
        if ($name instanceof Module) {
            $module = $name;
        }else {
            $module = $this->laravel['widgets']->findOrFail($name);
        }

        if ($module->isDisabled()) {
            $module->enable();

            $this->components->info("Widget [{$module}] enabled successful.");
        }else {
            $this->components->warn("Widget [{$module}] has already enabled.");
        }

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['widget', InputArgument::OPTIONAL, 'Widget name.'],
        ];
    }
}
