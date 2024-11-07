<?php
class User extends Controller
{
    public $data = [];
    protected $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function search($currentPage = 1)
    {
        $recordsPerPage = 5;
        $keyword = $_GET['keyword'] ?? '';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $recordsPerPage;
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/user/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/user/user/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/user/main.js'
        ];
        if (!empty($keyword)) {
            $searchUser = $this->model('UserModel')->search($keyword, $offset, $recordsPerPage);

            if ($searchUser === false) {
                $this->data['page_title'] = 'Not found';
                $this->data['href-back'] = _WEB_ROOT . '/backend/user';
                $this->data['contents'] = [
                    'components/admin/sidebar',
                    'components/errors/not_found'
                ];
            } else {
                $numberPage = $this->model->countPages($recordsPerPage, 'users', $keyword, ['name', 'email']);
                $this->data['users'] = $searchUser;
                $this->data['countAll'] = $this->model->countAllOrByKeyword('users', $keyword, ['name', 'email']);
                $this->data['numberPage'] = $numberPage;
            }
        }

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;
        $this->render('layouts/admin_layout', $this->data);
    }


    public function index($currentPage = 1)
    {
        $recordsPerPage = 5;
        $offset = ($currentPage - 1) * $recordsPerPage;
        $this->data['page_title'] = 'Danh sách người dùng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/user/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/user/user/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/user/main.js'
        ];

        $numberPage = $this->model->countPages($recordsPerPage, 'users');
        $this->data['users'] = $this->model('UserModel')->pagination($offset, $recordsPerPage);
        $this->data['countAll'] = $this->model->countAllOrByKeyword('users');
        $this->data['numberPage'] = $numberPage;

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

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
            'backend/user/user/create'
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
        $this->data['user'] = $this->model->findById('users', $id);

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

        $this->data['page_title'] = 'Cập nhật thông tin người dùng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/user/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/user/user/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/user/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function delete($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/user');
        }

        $this->data['user'] = $this->model->findById('users', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $deleteUser = $this->model('UserModel')->softDeleteUser($id);
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
            'backend/user/user/delete'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }
}
