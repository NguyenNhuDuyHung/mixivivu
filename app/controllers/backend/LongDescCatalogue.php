<?php
class LongDescCatalogue extends Controller
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

        $this->data['page_title'] = 'Danh sách nhóm long-desc';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/catalogue/long/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/descriptions/main.js'
        ];

        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $searchUser = $this->model('LongDescCatalogueModel')->search($keyword, $offset, $recordsPerPage);

            if ($searchUser === false) {
                $this->data['page_title'] = 'Not found';
                $this->data['href-back'] = _WEB_ROOT . '/backend/user/catalogue';
                $this->data['contents'] = [
                    'components/admin/sidebar',
                    'components/errors/not_found'
                ];
            } else {
                $numberPage = $this->model->countPages($recordsPerPage, 'long_desc_type', $keyword, ['type']);
                $this->data['long_desc_types'] = $searchUser;
                $this->data['countAll'] = $this->model->countAllOrByKeyword('long_desc_type', $keyword, ['type']);
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
        $this->data['page_title'] = 'Danh sách nhóm long-desc';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/catalogue/long/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/descriptions/main.js'
        ];

        $numberPage = $this->model->countPages($recordsPerPage, 'long_desc_type');
        $this->data['long_desc_types'] = $this->model('LongDescCatalogueModel')->pagination($offset, $recordsPerPage);
        $this->data['countAll'] = $this->model->countAllOrByKeyword('long_desc_type');
        $this->data['numberPage'] = $numberPage;

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/admin_layout', $this->data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $type = $_POST['type'];
            $create = $this->model('LongDescCatalogueModel')->create();

            if ($create) {
                header('Location: ' . _WEB_ROOT . '/backend/long-desc/catalogue');
            }

            $this->data['type'] = $type;
        }

        $this->data['page_title'] = 'Tạo nhóm long-desc';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/catalogue/long/create'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/descriptions/longdesctype.js'
        ];
        $this->render('layouts/admin_layout', $this->data);
    }

    public function update($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/long-desc/catalogue');
        }
        $this->data['long_desc_type'] = $this->model->findById('long_desc_type', $id, ['type']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $type = $_POST['type'];
            $update = $this->model('LongDescCatalogueModel')->updateDescCatalogue($id);
            if ($update) {
                header('Location: ' . _WEB_ROOT . '/backend/long-desc/catalogue');
            }
            $this->data['type'] = $type;
        }

        $this->data['page_title'] = 'Cập nhật thông tin nhóm long-desc';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/catalogue/long/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/descriptions/longdesctype.js'
        ];
        $this->render('layouts/admin_layout', $this->data);
    }

    public function delete($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/long-desc/catalogue');
        }
        $this->data['long_desc_type'] = $this->model->findById('long_desc_type', $id, ['type']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $delete = $this->model('LongDescCatalogueModel')->deleteDescCatalogue($id);
            if ($delete) {
                header('Location: ' . _WEB_ROOT . '/backend/long-desc/catalogue');
            }
        }

        $this->data['page_title'] = 'Xóa nhóm long-desc';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/catalogue/long/delete'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/descriptions/main.js'
        ];
        $this->render('layouts/admin_layout', $this->data);
    }
}
