<?php
class Hotel extends Controller
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

        $this->data['page_title'] = 'Quản lý hotel';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/ship/style.css'
        ];

        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/hotel/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];

        $numberPage = $this->model->countPages($recordsPerPage, 'hotel');
        $this->data['hotels'] = $this->model('HotelModel')->pagination($offset, $recordsPerPage);
        $this->data['countAll'] = $this->model->countAllOrByKeyword('hotel');
        $this->data['numberPage'] = $numberPage;

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/admin_layout', $this->data);
    }

    public function create()
    {
        $hotelFeatures = $this->model->findById('features', 3, ['*'], [], 'type', true);
        $cities = $this->model("HotelModel")->getAllCity();

        $this->data['hotelFeatures'] = $hotelFeatures;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $address = $_POST['address'];
            $map_link = $_POST['map_link'];
            $map_iframe_link = $_POST['map_iframe_link'];
            $default_price = $_POST['default_price'];
            $slug = $_POST['slug'];
            $admin = $_POST['admin'];
            $default_price = $_POST['default_price'];
            $create = $this->model('HotelModel')->createInfoHotel();
            if ($create) {
                header('Location: ' . _WEB_ROOT . '/backend/hotel');
            }

            $this->data['title'] = $title;
            $this->data['address'] = $address;
            $this->data['map_link'] = $map_link;
            $this->data['map_iframe_link'] = $map_iframe_link;
            $this->data['default_price'] = $default_price;
            $this->data['slug'] = $slug;
            $this->data['admin'] = $admin;
            $this->data['default_price'] = $default_price;
        }

        $this->data['cities'] = $cities;
        $this->data['cruise_categories'] = $this->model('ShipCatalogueModel')->getCategoryCruise();
        $this->data['type_products'] = $this->model('ShipModel')->getTypeProduct();

        $this->data['page_title'] = 'Thêm khách sạn';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/ship/style.css'
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/hotel/create'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/hotel/main.js'
        ];
        $this->render('layouts/admin_layout', $this->data);
    }

    public function update($id  = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/hotel');
        }
        $cities = $this->model("HotelModel")->getAllCity();

        $hotel = $this->model->findById('products p', $id, [
            'p.id AS id',
            'p.title AS title',
            'p.address AS address',
            'p.map_link AS map_link',
            'p.map_iframe_link AS map_iframe_link',
            'p.active AS active',
            'p.slug AS slug',
            'p.thumbnail AS thumbnail',
            'p.images AS images',
            'p.default_price AS default_price',
            'h.city_id AS city_id',
            'h.admin AS admin',
        ], [
            'hotel h' => 'h.id = p.id',
        ]);

        $this->data['hotel'] = $hotel;
        $this->data['features'] = $this->model->findById('features', 3, ['*'], [], 'type', true);
        $this->data['hotelFeatures'] = $this->model->findById('hotel_feature', $id, ['feature_id'], [], 'hotel_id', true);
        $this->data['hotelFeatures'] = array_column($this->data['hotelFeatures'], 'feature_id');
        $this->data['cities'] = $cities;

        if (!empty($this->data['hotel']['images'])) {
            $this->data['hotel']['images'] = explode(',', $this->data['hotel']['images']);
            $temp = [];
            foreach ($this->data['hotel']['images'] as $key => $image) {
                $temp[$key] = $image;
            }
            $_FILES['images'][] = implode(',', $temp);
        }

        if (!empty($this->data['hotel']['thumbnail'])) {
            $_FILES['thumbnail'][] = $this->data['hotel']['thumbnail'];
        }

        $this->data['targetDir_thumbnail'] = 'public/img/thumbnail';
        $this->data['targetDir_hotel'] = 'public/img/hotel';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $address = $_POST['address'];
            $admin = $_POST['admin'];
            $mapLink = $_POST['map_link'];
            $mapIframeLink = $_POST['map_iframe_link'];
            $slug = $_POST['slug'];
            $active = $_POST['active'];

            $update = $this->model('HotelModel')->updateInfoHotel($id);
            if ($update) {
                header('Location: ' . _WEB_ROOT . '/backend/hotel');
            }

            $this->data['title'] = $title;
            $this->data['address'] = $address;
            $this->data['admin'] = $admin;
            $this->data['map_link'] = $mapLink;
            $this->data['map_iframe_link'] = $mapIframeLink;
            $this->data['slug'] = $slug;
            $this->data['active'] = $active;
        }

        $this->data['page_title'] = 'Cập nhật thông tin khách sạn';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/ship/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/hotel/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/hotel/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function delete($id = 0)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/hotel');
        }

        $this->data['hotel'] = $this->model->findById('products', $id, ['title']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $delte = $this->model('HotelModel')->deleteHotel($id);
            if ($delte) {
                header('Location: ' . _WEB_ROOT . '/backend/hotel');
            }
        }

        $this->data['page_title'] = 'Xóa thông tin khách sạn';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
            'backend/ship/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/hotel/delete'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }
}
