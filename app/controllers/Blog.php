<?php
class Blog extends Controller
{
    public $model;
    public $data = [];
    public function __construct()
    {
        $this->model = new Model();
    }

    public function index($currentPage = 1)
    {
        $recordsPerPage = 6;
        $offset = ($currentPage - 1) * $recordsPerPage;
        $numberPage = $this->model->countPages($recordsPerPage, 'blog');
        $blogs = $this->model('BlogModel')->getAllBlog($recordsPerPage, $offset);
        $this->data['blogs'] = $blogs;
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

        $this->data['countAll'] = $this->model->countAllOrByKeyword('blog', null, ['title']);
        $this->data['numberPage'] = $numberPage;
        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/client_layout', data: $this->data);
    }
}
