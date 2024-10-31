<?php
class User extends Controller
{
    public $data = [];
    protected $model;

    public function __construct()
    {
        $this->model = new Model();
    }
    public function index($currentPage = 1)
    {
        $recordsPerPage = 5;
        $offset = ($currentPage - 1) * $recordsPerPage;
        $numberPage = $this->model('UserModel')->countPage($recordsPerPage);
        $this->data['users'] = $this->model('UserModel')->pagination($offset, $recordsPerPage);
        $this->data['countAllUser'] = $this->model('UserModel')->countAllUser();
        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['numberPage'] = $numberPage;
        $this->data['currentPage'] = $currentPage;
        $this->data['page_title'] = 'User';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/user/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/user/user'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/user/main.js'
        ];
        $this->render('layouts/admin_layout', $this->data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $role = $_POST['role'];
            $createUser = $this->model('UserModel')->create();
            if ($createUser) {
                header('Location: ' . _WEB_ROOT . '/backend/user');
            }

            $this->data['name'] = $name;
            $this->data['email'] = $email;
            $this->data['phone'] = $phone;
            $this->data['role'] = $role;
        }

        $this->data['page_title'] = 'Tạo người dùng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/user/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/user/create'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/user/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function update($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/user');
        }
        $this->data['user'] = $this->model('UserModel')->getUserById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $updateUser = $this->model('UserModel')->updateUser($id);
            if ($updateUser) {
                header('Location: ' . _WEB_ROOT . '/backend/user');
            }

            $this->data['name'] = $name;
            $this->data['email'] = $email;
            $this->data['phone'] = $phone;
            $this->data['password'] = $password;
            $this->data['role'] = $role;
        }

        $this->data['page_title'] = 'Cập nhật người dùng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/user/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/user/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function delete($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/user');
        }

        $this->data['user'] = $this->model('UserModel')->getUserById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $deleteUser = $this->model('UserModel')->deleteUser($id);
            if ($deleteUser) {
                header('Location: ' . _WEB_ROOT . '/backend/user');
            }
        }

        $this->data['page_title'] = 'Xóa người dùng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/user/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/user/delete'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }
}