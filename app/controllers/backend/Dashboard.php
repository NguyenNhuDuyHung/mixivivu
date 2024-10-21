<?php
class Dashboard extends Controller
{
    public $data = [];
    protected $model;
    public function __construct()
    {
        $this->model = new Model();
    }


    public function index()
    {
        if (!isset($_SESSION['user']) || $this->model->checkSesstionTimeOut('user')) {
            header('Location: ' . _WEB_ROOT . '/backend/login');
        }

        $this->data['page_title'] = 'Dashboard';
        $this->data['header'] = 'components/admin/header';
        $this->data['content'] = 'backend/dashboard';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['style'] = 'backend/dashboard/style.css';
        $this->render('layouts/admin_layout', data: $this->data);
    }
}