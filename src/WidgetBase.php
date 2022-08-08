<?php

namespace FGCQuickWeb\Widgets;

use Illuminate\Support\Facades\View;

abstract class WidgetBase extends WidgetAbstract
{
    private $data = array();
    public function __construct()
    {
        parent::__construct();
    }
    public function __invoke($key)
    {
       return __($this->nameWidget. "::lang.".$key);
    }
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }
    public function __set($name,$value){
        $this->data[$name] = $value;
    }
    public function view($view, $data = [], $mergeData = [])
    {
        if (View::exists("themes{$this->nameWidget}::" . $view)) {
            return view("themes{$this->nameWidget}::" . $view, array_merge(['__'=>$this],$data), $mergeData);
        } else {
            return view("{$this->nameWidget}::index", array_merge(['__'=>$this],[$data]), $mergeData);
        }
    }
}