<?php
class Blog extends Controller
{
    public $model;
    public $data = [];
    public function __construct()
    {
        $this->model = new Model();
    }

    public function index()
    {
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/blog/index',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/blog/style.css',
        ];

        $this->data['scripts'] = [
            'frontend/blog/main.js',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }
}
