<?php

use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\App;

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
function fgc_auto_load_widgets()
{
    $main_folder = dirname(app_path()) . DS . 'FGCWidgets';
    if (!is_dir($main_folder) && !file_exists($main_folder))
        return true;
    $app = App::getFacadeRoot();
    $folders = array_diff(scandir($main_folder), ['..', '.', '.gitignore', 'functions.php']);
    $modules = array_keys(Module::getByStatus(1));
    foreach ($folders as $item) {
        $json_path_file = $main_folder . DS . $item . DS . "widget.json";
        if (is_dir($main_folder . DS . $item) && file_exists($json_path_file)) {
            $result = fgc_get_content_json($json_path_file);
            //Check phụ thuộc trước
            if (!empty($result->dependencies)) {
                $is_lost_moudle = false;
                foreach ($result->dependencies as $module) {
                    if ($module != '' && !in_array($module, $modules)) {
                        $is_lost_moudle = true;
                        break;
                    }
                }
                if ($is_lost_moudle)
                    continue;
            }
            if (!empty($result->active) && (int)$result->active == 1) {
                if (!empty($result->main_file) && $result->main_file) {
                    if (file_exists($main_folder . DS . $item . DS . (string)$result->main_file . ".php")) {
                        fgc_register_provider($item, $result->providers, $app);
                        register_widget("\\FGCWidgets\\" . $item . "\\" . $result->main_file);
                    }
                } elseif (file_exists($main_folder . DS . $item . DS . $item . ".php")) {
                    fgc_register_provider($item, $result->providers, $app);
                    register_widget("\\FGCWidgets\\" . $item . "\\" . $item);
                }
            }
        }
    }
}

function fgc_get_content_xml_file($pathFile)
{
    try {
        if (file_exists($pathFile)) {
            return simplexml_load_file($pathFile);
        }
        return false;
    } catch (\Exception $e) {
        return false;
    }
}
function fgc_get_content_json($path)
{
    try {
        if (file_exists($path)) {
            return json_decode(file_get_contents($path));
        }
        return false;
    } catch (\Exception $ex) {
        //$trace = debug_backtrace();
        trigger_error($ex->getMessage());
        return false;
    }
}
function fgc_register_provider($nameWidget, $providers, $app)
{
    try {
        if (!empty($providers)) {
            foreach ($providers as $provider) {
                $app->register($provider);
            }
        } else {
            $app->register("\\FGCWidgets\\" . $nameWidget . "\\FGCServiceProvider");
        }
        return false;
    } catch (\Exception $ex) {
        return false;
    }
}
if (!function_exists('fgc_widget_path')) {
    function fgc_widget_path($name, $path = '')
    {
        $main_folder = dirname(app_path()) . DS . 'FGCWidgets';
        return $main_folder . DS . $name . ($path ? DS . $path : $path);
    }
}
