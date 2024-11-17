<?php
class Feature extends Controller
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
        $this->data['page_title'] = 'Danh sách tính đặc trưng của sản phẩm';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/feature/feature/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/feature/main.js'
        ];

        if (isset($_GET['keyword'])) {
            $searchFeature = $this->model('FeatureModel')->search($keyword, $offset, $recordsPerPage);

            if ($searchFeature === false) {
                $this->data['page_title'] = 'Not found';
                $this->data['href-back'] = _WEB_ROOT . '/backend/feature';
                $this->data['contents'] = [
                    'components/admin/sidebar',
                    'components/errors/not_found'
                ];
            } else {
                $numberPage = $this->model->countPages($recordsPerPage, 'features', $keyword, ['text']);
                $this->data['features'] = $searchFeature;
                $this->data['countAll'] = $this->model->countAllOrByKeyword('features', $keyword, ['text']);
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
        $this->data['page_title'] = 'Danh sách tính đặc trưng của sản phẩm';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/feature/feature/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/feature/main.js'
        ];

        $numberPage = $this->model->countPages($recordsPerPage, 'features');
        $this->data['features'] = $this->model('FeatureModel')->pagination($offset, $recordsPerPage);

        $this->data['countAll'] = $this->model->countAllOrByKeyword('features');
        $this->data['numberPage'] = $numberPage;

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/admin_layout', $this->data);
    }

    public function create()
    {
        $featureTypes = $this->model('FeatureModel')->getFeatureType();
        $this->data['feature_types'] = $featureTypes;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $text = $_POST['text'];
            $type = $_POST['type'];
            $createFeature = $this->model('FeatureModel')->create();
            if ($createFeature) {
                header('Location: ' . _WEB_ROOT . '/backend/feature');
            }

            $this->data['text'] = $text;
            $this->data['type'] = $type;
        }

        $this->data['page_title'] = 'Tạo đặc trưng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/feature/feature/create'
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
        $featureTypes = $this->model('FeatureModel')->getFeatureType();
        $this->data['feature_types'] = $featureTypes;
        $this->data['feature'] = $this->model->findById('features', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $text = $_POST['text'];
            $type = $_POST['type'];

            $updateFeature = $this->model('FeatureModel')->updateFeature($id);
            if ($updateFeature) {
                header('Location: ' . _WEB_ROOT . '/backend/feature');
            }

            $this->data['text'] = $text;
            $this->data['type'] = $type;
        }

        $this->data['page_title'] = 'Cập nhật thông tin của đặc trưng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/feature/feature/update'
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
            header('Location: ' . _WEB_ROOT . '/backend/feature');
        }

        $this->data['feature'] = $this->model->findById('features', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $deleteFeature = $this->model('FeatureModel')->deleteFeature($id);
            if ($deleteFeature) {
                header('Location: ' . _WEB_ROOT . '/backend/feature');
            }
        }

        $this->data['page_title'] = 'Xóa người dùng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/feature/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/feature/feature/delete'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }
}
