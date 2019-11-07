<?php
require_once 'Controller.php';
require_once 'models/StatModel.php';

class NotFoundController extends Controller
{
    public function __construct()
    {
    }
    function index_page()
    {
        header('HTTP/1.0 404 Not Found');
    }
}