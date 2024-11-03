<?php
class UserCatalogue extends Controller
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
        $this->data['page_title'] = 'Danh sách nhóm người dùng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/user/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/user/catalogue/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/user/user/main.js'
        ];

        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $searchUser = $this->model('UserCatalogueModel')->search($keyword, $offset, $recordsPerPage);

            if ($searchUser === false) {
                $this->data['page_title'] = 'Not found';
                $this->data['href-back'] = _WEB_ROOT . '/backend/user/catalogue';
                $this->data['contents'] = [
                    'components/admin/sidebar',
                    'components/errors/not_found'
                ];
            } else {
                $numberPage = $this->model->countPages($recordsPerPage, 'user_catalogues', $keyword, ['name']);
                $this->data['user_catalogues'] = $searchUser;
                $this->data['countAllUser'] = $this->model->countAllOrByKeyword('user_catalogues', $keyword, ['name']);
                $this->data['numberPage'] = $numberPage;
            }
        } else {
            $numberPage = $this->model->countPages($recordsPerPage, 'user_catalogues');
            $this->data['user_catalogues'] = $this->model('UserCatalogueModel')->pagination($offset, $recordsPerPage);
            $this->data['countAllUser'] = $this->model->countAllOrByKeyword('user_catalogues');
            $this->data['numberPage'] = $numberPage;
        }

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/admin_layout', $this->data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $createUserCatalogue = $this->model('UserCatalogueModel')->create();

            if ($createUserCatalogue) {
                header('Location: ' . _WEB_ROOT . '/backend/user/catalogue');
            }

            $this->data['name'] = $name;
            $this->data['description'] = $description;
        }

        $this->data['page_title'] = 'Tạo nhóm người dùng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/user/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/user/catalogue/create'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/user/main.js'
        ];
        $this->render('layouts/admin_layout', $this->data);
    }

    public function update($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/user/catalogue');
        }
        $this->data['user_catalogue'] = $this->model->findById('user_catalogues', $id, ['name', 'description']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $updateUserCatalogue = $this->model('UserCatalogueModel')->updateUserCatalogue($id);
            if ($updateUserCatalogue) {
                header('Location: ' . _WEB_ROOT . '/backend/user/catalogue');
            }
            $this->data['name'] = $name;
            $this->data['description'] = $description;
        }

        $this->data['page_title'] = 'Cập nhật thông tin nhóm người dùng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/user/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/user/catalogue/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/user/main.js'
        ];
        $this->render('layouts/admin_layout', $this->data);
    }

    public function delete($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/user/catalogue');
        }
        $this->data['user_catalogue'] = $this->model->findById('user_catalogues', $id, ['name', 'description']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $deleteUserCatalogue = $this->model('UserCatalogueModel')->softDeleteUserCatalogue($id);
            if ($deleteUserCatalogue) {
                header('Location: ' . _WEB_ROOT . '/backend/user/catalogue');
            }
        }

        $this->data['page_title'] = 'Xóa nhóm người dùng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/user/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/user/catalogue/delete'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/user/main.js'
        ];
        $this->render('layouts/admin_layout', $this->data);
    }
}
