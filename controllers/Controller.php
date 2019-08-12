<?php


class Controller
{
    function template($__view, $__data)
    {
        extract($__data);

        ob_start();

        require_once $__view;

        return ob_get_clean();
    }
}