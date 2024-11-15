<?php
class Ship extends Controller
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

        $this->data['page_title'] = 'Quản lý du thuyền';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/ship/style.css'
        ];

        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/ship/ship/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/ship/main.js'
        ];

        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $searchUser = $this->model('ShipModel')->search($keyword, $offset, $recordsPerPage);

            if ($searchUser === false) {
                $this->data['page_title'] = 'Not found';
                $this->data['href-back'] = _WEB_ROOT . '/backend/ship';
                $this->data['contents'] = [
                    'components/admin/sidebar',
                    'components/errors/not_found'
                ];
            } else {
                $numberPage = $this->model->countPages($recordsPerPage, 'products', $keyword, ['title']);
                $this->data['ships'] = $searchUser;
                $this->data['countAll'] = $this->model->countAllOrByKeyword('products', $keyword, ['title']);
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

        $this->data['page_title'] = 'Quản lý du thuyền';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/ship/style.css'
        ];

        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/ship/ship/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/ship/main.js'
        ];

        $numberPage = $this->model->countPages($recordsPerPage, 'products');
        $this->data['ships'] = $this->model('ShipModel')->pagination($offset, $recordsPerPage);
        $this->data['countAll'] = $this->model->countAllOrByKeyword('products');
        $this->data['numberPage'] = $numberPage;

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/admin_layout', $this->data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $address = $_POST['address'];
            $shell = $_POST['shell'];
            $year = $_POST['year'];
            $cabin = $_POST['cabin'];
            $admin = $_POST['admin'];
            $mapLink = $_POST['map_link'];
            $mapIframeLink = $_POST['map_iframe_link'];
            $schedule = $_POST['schedule'];
            $trip = $_POST['trip'];
            $slug = $_POST['slug'];
            $typeProduct = $_POST['type_product'];
            $active = $_POST['active'];
            $categoryId =  $_POST['category_id'];

            $createInfoShip = $this->model('ShipModel')->createInfoShip();

            $this->data['title'] = $title;
            $this->data['address'] = $address;
            $this->data['shell'] = $shell;
            $this->data['year'] = $year;
            $this->data['cabin'] = $cabin;
            $this->data['admin'] = $admin;
            $this->data['map_link'] = $mapLink;
            $this->data['map_iframe_link'] = $mapIframeLink;
            $this->data['schedule'] = $schedule;
            $this->data['trip'] = $trip;
            $this->data['slug'] = $slug;
            $this->data['type_product'] = $typeProduct;
            $this->data['active'] = $active;
            $this->data['category_id'] = $categoryId;

            if ($createInfoShip) {
                header('Location: ' . _WEB_ROOT . '/backend/ship');
            }
        }

        $this->data['cruise_categories'] = $this->model('ShipModel')->getCategoryCruise();
        $this->data['type_products'] = $this->model('ShipModel')->getTypeProduct();

        $this->data['page_title'] = 'Thêm du thuyền';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/ship/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/ship/ship/create'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/ship/main.js'
        ];
        $this->render('layouts/admin_layout', $this->data);
    }

    public function update($id  = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/ship');
        }
        $this->data['ships'] = $this->model->findById('products p', $id, [
            'p.id AS id',
            'p.title AS title',
            'p.address AS address',
            'p.map_link AS map_link',
            'p.map_iframe_link AS map_iframe_link',
            'p.schedule AS schedule',
            'p.active AS active',
            'p.slug AS slug',
            'p.thumbnail AS thumbnail',
            'p.images AS images',
            'pt.name AS name',
            'cr.year AS year',
            'cr.cabin AS cabin',
            'cr.shell AS shell',
            'cr.trip AS trip',
            'cr.admin AS admin',
            'pt.name AS type_product',
            'ct.name AS category_id'
        ], [
            'product_type pt' => 'pt.id = p.type_product',
            'cruise cr' => 'cr.id = p.id',
            'cruise_category ct' => 'cr.category_id = ct.id'
        ]);

        if (!empty($this->data['ships']['images'])) {
            $this->data['ships']['images'] = explode(',', $this->data['ships']['images']);
            $temp = [];
            foreach ($this->data['ships']['images'] as $key => $image) {
                $temp[$key] = $image;
            }
            $_FILES['images'][] = implode(',', $temp);
        }

        if (!empty($this->data['ships']['thumbnail'])) {
            $_FILES['thumbnail'][] = $this->data['ships']['thumbnail'];
        }

        $this->data['targetDir_thumbnail'] = 'public/img/thumbnail';
        $this->data['targetDir_tour'] = 'public/img/tour';
        $this->data['cruise_categories'] = $this->model('ShipModel')->getCategoryCruise();
        $this->data['type_products'] = $this->model('ShipModel')->getTypeProduct();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $address = $_POST['address'];
            $shell = $_POST['shell'];
            $year = $_POST['year'];
            $cabin = $_POST['cabin'];
            $admin = $_POST['admin'];
            $mapLink = $_POST['map_link'];
            $mapIframeLink = $_POST['map_iframe_link'];
            $schedule = $_POST['schedule'];
            $trip = $_POST['trip'];
            $slug = $_POST['slug'];
            $typeProduct = $_POST['type_product'];
            $active = $_POST['active'];
            $categoryId =  $_POST['category_id'];

            $update = $this->model('ShipModel')->updateInfoCruise($id);
            if ($update) {
                header('Location: ' . _WEB_ROOT . '/backend/ship');
            }

            $this->data['title'] = $title;
            $this->data['address'] = $address;
            $this->data['shell'] = $shell;
            $this->data['year'] = $year;
            $this->data['cabin'] = $cabin;
            $this->data['admin'] = $admin;
            $this->data['map_link'] = $mapLink;
            $this->data['map_iframe_link'] = $mapIframeLink;
            $this->data['schedule'] = $schedule;
            $this->data['trip'] = $trip;
            $this->data['slug'] = $slug;
            $this->data['type_product'] = $typeProduct;
            $this->data['active'] = $active;
            $this->data['category_id'] = $categoryId;
        }

        $this->data['page_title'] = 'Cập nhật thông tin du thuyền';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/ship/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/ship/ship/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/ship/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function delete($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/ship');
        }

        $this->data['ships'] = $this->model->findById('products', $id, ['title']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $deleteCruise = $this->model('ShipModel')->deleteCruise($id);
            if ($deleteCruise) {
                header('Location: ' . _WEB_ROOT . '/backend/ship');
            }
        }

        $this->data['page_title'] = 'Xóa thông tin du thuyền';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/ship/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/ship/ship/delete'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/ship/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function feature($id)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/ship');
        }

        $this->data['features'] = $this->model('FeatureModel')->getAllFeatures();
        $this->data['productFeatures'] = $this->model->findById('product_feature', $id, ['feature_id'], [], 'product_id', true);
        $this->data['productFeatures'] = array_column($this->data['productFeatures'], 'feature_id');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $update = $this->model('ShipModel')->updateProductFeature($id);
            if ($update) {
                header('Location: ' . _WEB_ROOT . '/backend/ship/update/' . $id);
            }
        }

        $this->data['page_title'] = 'Cập nhật tính năng của du thuyền';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/ship/style.css'
        ];

        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/ship/ship/feature'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/ship/main.js'
        ];

        $this->render('layouts/admin_layout', $this->data);
    }
}
