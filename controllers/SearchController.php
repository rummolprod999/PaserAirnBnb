<?php
require_once 'Controller.php';
require_once 'models/SearchModel.php';

class SearchController extends Controller
{
    private $model = null;

    public function __construct()
    {
        $this->model = new SearchModel();
    }
    function index_page()
    {
        $data = $this->model->get_data();
        echo $this->template('templates/search.php', ["title" => "Search free periods", "data" => $data]);
    }
}