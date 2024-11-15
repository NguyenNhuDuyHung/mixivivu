<?php
class Auth extends Controller
{
    public $data = [];
    protected $model;
    public function __construct()
    {
        $this->model = new Model();
    }
    public function login()
    {
        if ($this->model->isLogin()) {
            header('Location: ' . _WEB_ROOT . '/backend/dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $this->model('AuthModel')->checkLogin($email, $password);

            if ($this->model('AuthModel')->checkLogin($email, $password)) {
                $this->data['error'] = $this->model('AuthModel')->checkLogin($email, $password);
            }

            $this->data['email'] = $email;
            $this->data['password'] = $password;
        }

        $this->data['page_title'] = 'Login';
        $this->data['contents'] = ['backend/login'];
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/login/style.css',
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/login/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model('AuthModel')->logout();
            $_SESSION['logout-success'] = "Đăng xuất thành công!";

            header('Location: ' . _WEB_ROOT . '/backend/login');
        }
    }
}