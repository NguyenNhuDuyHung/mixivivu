<?php
class ShortDesc extends Controller
{
    public $data = [];
    protected $model;
    public function __construct()
    {
        $this->model = new Model;
        $this->checkLogin();
    }

    public function search()
    {
        $recordsPerPage = 5;
        $keyword = $_GET['keyword'] ?? '';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $recordsPerPage;

        $this->data['page_title'] = 'Danh sách mô tả ngắn';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css'
        ];

        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/description/short/index'
        ];

        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];

        if (isset($_GET['keyword'])) {
            $search = $this->model('DescriptionModel')->searchShortDesc($keyword, $offset, $recordsPerPage);

            if ($search === false) {
                $this->data['page_title'] = 'Not found';
                $this->data['href-back'] = _WEB_ROOT . '/backend/user';
                $this->data['contents'] = [
                    'components/admin/sidebar',
                    'components/errors/not_found'
                ];
            } else {
                $numberPage = $this->model('DescriptionModel')->countPageShortDescSearch($keyword, $recordsPerPage);
                $this->data['short_descs'] = $search;
                $this->data['countAll'] = $this->model('DescriptionModel')->countAllShortDescSearch($keyword);
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
        $this->data['page_title'] = 'Danh sách mô tả ngắn';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css'
        ];

        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/description/short/index'
        ];

        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];

        $numberPage = $this->model->countPagesDistinct($recordsPerPage, 'short_desc', ['product_id']);
        $this->data['short_descs'] = $this->model('DescriptionModel')->paginationShortDesc($offset, $recordsPerPage);
        $this->data['countAll'] = $this->model->countAllDistinct('short_desc', null, ['product_id']);
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
            $create = $this->model('DescriptionModel')->createShortDesc();
            if ($create) {
                header('Location: ' . _WEB_ROOT . '/backend/short-desc');
            }
        }

        $this->data['page_title'] = 'Tạo mô tả ngắn';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/description/short/create'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/descriptions/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function update($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/short-desc');
        }

        $products = $this->model('DescriptionModel')->getProduct();
        $descriptions = array_column($this->model('DescriptionModel')->findById('short_desc', $id, ['description'], [], 'product_id', true), 'description');
        $this->data['descriptions'] = $descriptions;
        $this->data['products'] = $products;
        $this->data['id'] = $id;
        $this->data['short_desc'] = $this->model->findById('short_desc', $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $description = $_POST['description'];
            $product_id = $_POST['product_id'];
            $create = $this->model('DescriptionModel')->updateShortDesc($id);
            if ($create) {
                header('Location: ' . _WEB_ROOT . '/backend/short-desc');
            }

            $this->data['description'] = $description;
            $this->data['product_id'] = $product_id;
        }

        $this->data['page_title'] = 'Cập nhật mô tả ngắn';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/description/short/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/descriptions/update.js',
            'backend/descriptions/validate.js',
            'backend/descriptions/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function delete($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/short-desc');
        }

        $this->data['product'] = $this->model->findById('products', $id, ['title'],);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $delete = $this->model('DescriptionModel')->deleteShortDesc($id);
            if ($delete) {
                header('Location: ' . _WEB_ROOT . '/backend/short-desc');
            }
        }

        $this->data['page_title'] = 'Xóa tất cả mô tả ngắn của sản phẩm ';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/descriptions/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/descriptions/description/short/delete'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];

        $this->render('layouts/admin_layout', data: $this->data);
    }
}
