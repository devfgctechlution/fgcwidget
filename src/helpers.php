<?php

use Nwidart\Modules\Facades\Module;

if(!defined('DS')){
    define('DS',DIRECTORY_SEPARATOR);
}
function fgc_auto_load_widgets($app){
    $mainFolder = dirname(app_path()) . DS . 'FGCWidgets';
    if(!is_dir($mainFolder) && !file_exists($mainFolder))
       return true;
    $folders = array_diff(scandir($mainFolder),['..','.','.gitignore','functions.php']);
    $modules = array_keys(Module::getByStatus(1));
    foreach($folders as $item){
        $jsonPathFile = $mainFolder.DS.$item.DS."widget.json";
        if(is_dir($mainFolder.DS.$item) && file_exists($jsonPathFile)){
            $resultFile = fgc_get_content_json($jsonPathFile);
            //Check phụ thuộc trước
            if(!empty($resultFile->dependencies)){
                $isLostMoudle = false;
                foreach($resultFile->dependencies as $module){
                    if($module!='' && !in_array($module,$modules)){
                        $isLostMoudle = true;
                        break;
                    }
                }
                if($isLostMoudle)
                 continue;
            }
            if(!empty($resultFile->active) && (int)$resultFile->active == 1){
                if(!empty($resultFile->main_file) && $resultFile->main_file){
                  if(file_exists($mainFolder.DS.$item.DS.(string)$resultFile->main_file.".php")){
                    fgc_register_provider($item,$resultFile->providers,$app);
                    register_widget("\\FGCWidgets\\".$item."\\".$resultFile->main_file);
                  }
                }elseif(file_exists($mainFolder.DS.$item.DS.$item.".php")){
                    fgc_register_provider($item,$resultFile->providers,$app);
                    register_widget("\\FGCWidgets\\".$item."\\".$item);
                }

            }
        }
    }
}
fgc_auto_load_widgets($this->app);

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
function fgc_get_content_json($path){
    try {
        if (file_exists($path)) {
            return json_decode(file_get_contents($path));
        }
        return false;
    } catch (\Exception $e) {
        return false;
    }
}
function fgc_register_provider($widgetname, $providers, $app)
{
    try {
        if (!empty($providers)) {
            foreach ($providers as $provider) {
                $app->register($provider);
            }
        } else {
            $app->register("\\FGCWidgets\\" . $widgetname . "\\FGCServiceProvider");
        }
        return false;
    } catch (\Exception $ex) {
        return false;
    }
}
if (! function_exists('fgc_widget_path')) {
    function widget_path($name, $path = '')
    {
        $mainFolder = dirname(app_path()) . DS . 'FGCWidgets';
        return $mainFolder.DS.$name . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
