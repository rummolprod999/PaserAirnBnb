<?php


class Controller
{
    function template($__view, $__data)
    {
        extract($__data, EXTR_PREFIX_SAME, "templ_");

        ob_start();
        require_once 'templates/header.php';
        require_once $__view;
        require_once 'templates/footer.php';

        return ob_get_clean();
    }
}