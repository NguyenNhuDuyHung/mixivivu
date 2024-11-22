<?php
class Home extends Controller
{
    public $model;
    public $data = [];
    public function __construct()
    {
        $this->model = new Model();
    }
    public function index()
    {
        $cruiseCategories = $this->model('ShipCatalogueModel')->getCategoryCruise(['id, name', 'image']);
        $popularCruises = $this->model('ShipModel')->getPopularCruises();
        $shipBlog = $this->model('BlogModel')->getBlogByType('ship');
        $this->data['shipBlog'] = $shipBlog;
        $this->data['cruiseCategories'] = $cruiseCategories;
        $this->data['popularCruises'] = $popularCruises;

        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/home/index',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/home/style.css',
        ];

        $this->data['scripts'] = [
            'frontend/home/main.js',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }
}
