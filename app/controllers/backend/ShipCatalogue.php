<?php
class Shipcatalogue extends Controller
{
    public $data = [];
    protected $model;

    public function __construct()
    {
        $this->model = new Model();
        $this->checkLogin();
    }

    public function search($currentPage = 1)
    {
        $recordsPerPage = 5;
        $keyword = $_GET['keyword'] ?? '';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $recordsPerPage;

        $this->data['page_title'] = 'Quản lý nhóm du thuyền';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/ship/style.css'
        ];

        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/ship/catalogue/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];

        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $search = $this->model('ShipCatalogueModel')->search($keyword, $offset, $recordsPerPage);

            if ($search === false) {
                $this->data['page_title'] = 'Not found';
                $this->data['href-back'] = _WEB_ROOT . '/backend/ship/catalogue';
                $this->data['contents'] = [
                    'components/admin/sidebar',
                    'components/errors/not_found'
                ];
            } else {
                $numberPage = $this->model->countPages($recordsPerPage, 'cruise_category', $keyword, ['name']);
                $this->data['shipCatalogues'] = $search;
                $this->data['countAll'] = $this->model->countAllOrByKeyword('cruise_category', $keyword, ['name']);
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

        $this->data['page_title'] = 'Quản lý nhóm du thuyền';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/ship/style.css'
        ];

        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/ship/catalogue/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];

        $numberPage = $this->model->countPages($recordsPerPage, 'cruise_category');
        $this->data['shipCatalogues'] = $this->model('ShipCatalogueModel')->pagination($offset, $recordsPerPage);
        $this->data['countAll'] = $this->model->countAllOrByKeyword('cruise_category');
        $this->data['numberPage'] = $numberPage;

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/admin_layout', $this->data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $this->data['name'] = $name;
            $create = $this->model('ShipCatalogueModel')->createShipCatalogue();

            if ($create) {
                header('Location: ' . _WEB_ROOT . '/backend/ship/catalogue');
            }
        }

        $this->data['page_title'] = 'Thêm danh mục du thuyền';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/ship/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/ship/catalogue/create'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/ship/catalogue/main.js'
        ];
        $this->render('layouts/admin_layout', $this->data);
    }

    public function update($id  = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/ship/catalogue');
        }

        $this->data['target_dir'] = 'public/img/ship-category/';
        $this->data['ship_catalogue'] = $this->model->findById('cruise_category', $id);
        if (!empty($this->data['ship_catalogue']['image'])) {
            $_FILES['image'][] = $this->data['ship_catalogue']['image'];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $update = $this->model('ShipCatalogueModel')->updateShipCatalogue($id);
            if ($update) {
                header('Location: ' . _WEB_ROOT . '/backend/ship/catalogue');
            }
        }

        $this->data['page_title'] = 'Cập nhật danh mục du thuyền';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/ship/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/ship/catalogue/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/ship/catalogue/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function delete($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/ship/catalogue');
        }

        $this->data['ship_catalogue'] = $this->model->findById('cruise_category', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $delete = $this->model('ShipCatalogueModel')->deleteShipCatalogue($id);
            if ($delete) {
                header('Location: ' . _WEB_ROOT . '/backend/ship/catalogue');
            }
        }

        $this->data['page_title'] = 'Xóa danh mục du thuyền';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/ship/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/ship/catalogue/delete'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/ship/catalogue/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }
}
