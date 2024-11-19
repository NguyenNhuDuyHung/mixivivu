<?php
class FeatureCatalogue extends Controller
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

        $this->data['page_title'] = 'Danh sách nhóm đặc trưng của sản phẩm';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/feature/catalogue/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/feature/main.js'
        ];

        if (isset($_GET['keyword'])) {
            $searchFeatureType = $this->model('FeatureCatalogueModel')->search($keyword, $offset, $recordsPerPage);

            if ($searchFeatureType === false) {
                $this->data['page_title'] = 'Not found';
                $this->data['href-back'] = _WEB_ROOT . '/backend/feature/catalogue';
                $this->data['contents'] = [
                    'components/admin/sidebar',
                    'components/errors/not_found'
                ];
            } else {
                $numberPage = $this->model->countPages($recordsPerPage, 'feature_types', $keyword, ['name']);
                $this->data['featureCatalogues'] = $searchFeatureType;
                $this->data['countAll'] = $this->model->countAllOrByKeyword('feature_types', $keyword, ['name']);
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
        $this->data['page_title'] = 'Danh sách nhóm đặc trưng của sản phẩm';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/feature/catalogue/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/feature/main.js'
        ];

        $numberPage = $this->model->countPages($recordsPerPage, 'feature_types');
        $this->data['featureCatalogues'] = $this->model('FeatureCatalogueModel')->pagination($offset, $recordsPerPage);

        $this->data['countAll'] = $this->model->countAllOrByKeyword('feature_types');
        $this->data['numberPage'] = $numberPage;

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/admin_layout', $this->data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $createFeature = $this->model('FeatureCatalogueModel')->create();
            if ($createFeature) {
                header('Location: ' . _WEB_ROOT . '/backend/feature/catalogue');
            }

            $this->data['name'] = $name;
        }

        $this->data['page_title'] = 'Tạo loại đặc trưng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/feature/catalogue/create'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/feature/main.js'
        ];

        $this->render('layouts/admin_layout', $this->data);
    }

    public function update($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/user');
        }
        $this->data['feature_type'] = $this->model->findById('feature_types', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];

            $update = $this->model('FeatureCatalogueModel')->updateFeatureType($id);
            if ($update) {
                header('Location: ' . _WEB_ROOT . '/backend/feature/catalogue');
            }

            $this->data['name'] = $name;
        }

        $this->data['page_title'] = 'Cập nhật loại đặc trưng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/feature/catalogue/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/feature/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function delete($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/feature/catalogue');
        }

        $this->data['feature_type'] = $this->model->findById('feature_types', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $delete = $this->model('FeatureCatalogueModel')->deleteFeatureType($id);
            if ($delete) {
                header('Location: ' . _WEB_ROOT . '/backend/feature/catalogue');
            }
        }

        $this->data['page_title'] = 'Xóa loại đặc trưng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/feature/catalogue/delete'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }
}
