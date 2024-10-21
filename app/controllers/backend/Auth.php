<?php
class Auth extends Controller
{
    public $data = [];
    public function __construct()
    {
    }
    public function login()
    {
        if(isset($_SESSION['user'])) {
            header('Location: ' . _WEB_ROOT . '/backend/dashboard');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $this->model('AuthModel')->checkLogin($username, $password);

            if ($this->model('AuthModel')->checkLogin($username, $password)) {
                $this->data['error'] = $this->model('AuthModel')->checkLogin($username, $password);
            }

            $this->data['username'] = $username;
            $this->data['password'] = $password;
        }

        $this->data['page_title'] = 'Login';
        $this->data['content'] = 'backend/login';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['style'] = 'backend/login/style.css';
        $this->data['script'] = 'backend/login/main.js';
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function logout()
    {
        $this->model('AuthModel')->logout();
    }
}