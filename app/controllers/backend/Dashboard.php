<?php
class Dashboard extends Controller
{
    public $data = [];
    protected $model;
    public function __construct()
    {
        $this->model = new Model();
        $this->checkLogin();
    }

    public function index()
    {
        $loginSuccessMessage = isset($_SESSION['login-success']) ? $_SESSION['login-success'] : '';
        $this->data['login-success'] = $loginSuccessMessage;
        $this->model->removeSession('login-success');

        $this->data['page_title'] = 'Dashboard';
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/dashboard',
        ];
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/dashboard/style.css',
        ];

        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];

        $this->render('layouts/admin_layout', data: $this->data);
    }
}
