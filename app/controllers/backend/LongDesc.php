<?php
class LongDesc extends Controller
{
    public $data = [];
    protected $model;
    public function __construct()
    {
        $this->model = new Model;
        $this->checkLogin();
    }
    public function search($currentPage = 1)
    {
        $recordsPerPage = 5;
        $keyword = $_GET['keyword'] ?? '';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $recordsPerPage;

        $recordsPerPage = 5;
        $offset = ($currentPage - 1) * $recordsPerPage;
        $this->data['page_title'] = 'Danh sách mô tả chi tiết';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css'
        ];

        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/description/long/index'
        ];

        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/descriptions/main.js'
        ];

        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $search = $this->model('LongDescModel')->search($keyword, $offset, $recordsPerPage);

            if ($search === false) {
                $this->data['page_title'] = 'Not found';
                $this->data['href-back'] = _WEB_ROOT . '/backend/long-desc';
                $this->data['contents'] = [
                    'components/admin/sidebar',
                    'components/errors/not_found'
                ];
            } else {
                $numberPage = $this->model->countPagesDistinct($recordsPerPage, 'long_desc', ['product_id']);
                $this->data['long_descs'] = $this->model('LongDescModel')->pagination($offset, $recordsPerPage);
                $this->data['countAll'] = $this->model->countAllDistinct('long_desc', null, ['product_id']);
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
        $this->data['page_title'] = 'Danh sách mô tả chi tiết';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css'
        ];

        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/description/long/index'
        ];

        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];

        $numberPage = $this->model->countPagesDistinct($recordsPerPage, 'long_desc', ['product_id']);
        $this->data['long_descs'] = $this->model('LongDescModel')->pagination($offset, $recordsPerPage);
        $this->data['countAll'] = $this->model->countAllDistinct('long_desc', null, ['product_id']);
        $this->data['numberPage'] = $numberPage;

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/admin_layout', $this->data);
    }

    public function create()
    {
        $products = $this->model('DescriptionModel')->getProduct();
        $this->data['products'] = $products;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $create = $this->model('LongDescModel')->createLongDesc();
            if ($create) {
                header('Location: ' . _WEB_ROOT . '/backend/long-desc');
            }
        }

        $this->data['page_title'] = 'Tạo mô tả';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/description/long/create'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/descriptions/longdesc.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function update($id)
    {
        $products = $this->model('DescriptionModel')->getProduct();
        $this->data['products'] = $products;

        $longDescs = $this->model('LongDescModel')->findById('long_desc', $id, ['*'], [], 'product_id', true);
        $this->data['descriptions'] = $longDescs;
        $this->data['products'] = $products;
        $this->data['id'] = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = $_POST['product_id'];
            $create = $this->model('LongDescModel')->updateLongDesc($id);
            if ($create) {
                header('Location: ' . _WEB_ROOT . '/backend/long-desc');
            }

            $this->data['product_id'] = $product_id;
        }

        $this->data['page_title'] = 'Cập nhật mô tả chi tiết';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/description/long/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/descriptions/longdesc.js',
            'backend/descriptions/longdescUpdate.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function delete($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/long-desc');
        }

        $this->data['product'] = $this->model->findById('products', $id, ['title'],);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $delete = $this->model('LongDescModel')->deleteLongDesc($id);
            if ($delete) {
                header('Location: ' . _WEB_ROOT . '/backend/long-desc');
            }
        }

        $this->data['page_title'] = 'Xóa tất cả mô tả chi tiết';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/description/long/delete'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/descriptions/longdesc.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }
}
