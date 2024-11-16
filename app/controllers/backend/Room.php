<?php
class Room extends Controller
{
    public $data = [];
    protected $model;
    public function __construct()
    {
        $this->model = new Model;
    }

    public function index($currentPage = 1)
    {
        $recordsPerPage = 5;
        $offset = ($currentPage - 1) * $recordsPerPage;
        $this->data['page_title'] = 'Quản lý phòng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/descriptions/style.css'
        ];

        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/room/index'
        ];

        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/descriptions/main.js'
        ];

        $numberPage = $this->model->countPagesDistinct($recordsPerPage, 'rooms', null, ['product_id']);
        $this->data['rooms'] = $this->model('RoomModel')->pagination($offset, $recordsPerPage);
        $this->data['countAll'] = $this->model->countAllDistinct('rooms', null, ['product_id']);
        $this->data['numberPage'] = $numberPage;

        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;

        $this->render('layouts/admin_layout', $this->data);
    }

    public function create()
    {
        $products = $this->model('DescriptionModel')->getProduct();
        $roomFeature = $this->model->findById('features', 1, ['*'], [], 'type', true);

        $this->data['roomFeatures'] = $roomFeature;
        $this->data['products'] = $products;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = $_POST['product_id'];
            $title = $_POST['title'];
            $size = $_POST['size'];
            $max_persons = $_POST['max_persons'];
            $price = $_POST['price'];
            $sale_prices = $_POST['sale_prices'];

            $create = $this->model('RoomModel')->create();
            if ($create) {
                header('Location: ' . _WEB_ROOT . '/backend/room');
            }

            $this->data['product_id'] = $product_id;
            $this->data['title'] = $title;
            $this->data['size'] = $size;
            $this->data['max_persons'] = $max_persons;
            $this->data['price'] = $price;
            $this->data['sale_prices'] = $sale_prices;
        }

        $this->data['page_title'] = 'Tạo phòng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/room/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/room/create'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/room/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function update($id)
    {
        $rooms = $this->model->findById('rooms', $id, ['*'], [], 'product_id', true);
        $this->data['product_id'] = $id;
        $this->data['rooms'] = $rooms;

        $this->data['page_title'] = 'Cập nhật thông tin các phòng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/room/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/room/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function updateRoomDetails($id)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/room');
        }
        $products = $this->model('DescriptionModel')->getProduct();
        $room = $this->model->findById('rooms', $id, ['*'], [], 'id');
        $room['images'] = explode(',', $room['images']);
        $roomFeature = $this->model->findById('features', 1, ['*'], [], 'type', true);
        $roomFeatureSelected = array_column($this->model->findById('rooms_feature', $id, ['*'], [], 'room_id', true), 'feature_id');

        $this->data['roomFeatureSelected'] = $roomFeatureSelected;
        $this->data['roomFeatures'] = $roomFeature;
        $this->data['products'] = $products;
        $this->data['product_id'] = $room['product_id'];
        $this->data['room'] = $room;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = $_POST['product_id'];
            $title = $_POST['title'];
            $size = $_POST['size'];
            $max_persons = $_POST['max_persons'];
            $price = $_POST['price'];
            $sale_prices = $_POST['sale_prices'];

            $update = $this->model('RoomModel')->updateRoom($id);
            if ($update) {
                header('Location: ' . _WEB_ROOT . '/backend/room');
            }

            $this->data['product_id'] = $product_id;
            $this->data['title'] = $title;
            $this->data['size'] = $size;
            $this->data['max_persons'] = $max_persons;
            $this->data['price'] = $price;
            $this->data['sale_prices'] = $sale_prices;
        }

        $this->data['page_title'] = 'Cập nhật thông tin chi tiết';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/room/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/room/updateDetail'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/room/main.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function deleteRoomDetails($id)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/room');
        }

        $this->data['room'] = $this->model->findById('rooms', $id, ['title'],);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $delete = $this->model('RoomModel')->deleteOneRoom($id);
            if ($delete) {
                header('Location: ' . _WEB_ROOT . '/backend/room');
            }
        }

        $this->data['page_title'] = 'Xóa 1 phòng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/room/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/room/deleteDetail'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }

    public function delete($id)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/room');
        }

        $rooms = $this->model->findById('rooms', $id, ['title'], [], 'product_id', true);
        $this->data['rooms'] = $rooms;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $delete = $this->model('RoomModel')->deleteAllRoom($id);
            if ($delete) {
                header('Location: ' . _WEB_ROOT . '/backend/room');
            }
        }

        $this->data['page_title'] = 'Xóa tất cả';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/descriptions/style.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/room/delete',
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }
}
