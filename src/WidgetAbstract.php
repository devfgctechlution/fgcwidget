<?php

namespace FGCQuickWeb\Widgets;


abstract class WidgetAbstract
{
    function __construct()
    {
        add_action($this->data()['action'], function ($data) {
            $this->widget($data);
        });

        add_filter('register_data_widget', function ($data) {
            $data[] = $this->data();
            return $data;
        });
    }

    abstract public function data();

    abstract public function widget($data);
}