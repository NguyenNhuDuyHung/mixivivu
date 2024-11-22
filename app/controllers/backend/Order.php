<?php
class Order extends Controller
{
    public $data = [];
    protected $model;
    public function __construct()
    {
        $this->model = new Model;
    }

    public function search($currentPage = 1)
    {
        $recordsPerPage = 5;
        $keyword = $_GET['keyword'] ?? '';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $recordsPerPage;
        $this->data['page_title'] = 'Danh sách đơn hàng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/order/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];

        if (isset($_GET['keyword'])) {
            $search = $this->model('OrderModel')->search($keyword, $offset, $recordsPerPage);

            if ($search === false) {
                $this->data['page_title'] = 'Not found';
                $this->data['href-back'] = _WEB_ROOT . '/backend/order';
                $this->data['contents'] = [
                    'components/admin/sidebar',
                    'components/errors/not_found'
                ];
            } else {
                $numberPage = $this->model->countPages($recordsPerPage, 'booking', $keyword);
                $this->data['orders'] = $search;
                $this->data['countAll'] = $this->model->countAllOrByKeyword('booking', $keyword);
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
        $this->data['page_title'] = 'Danh sách đơn hàng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'backend/main.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/order/index'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
        ];

        $this->data['orders'] = $this->model('OrderModel')->pagination($offset, $recordsPerPage);
        $numberPage = $this->model->countPages($recordsPerPage, 'booking');
        $this->data['countAll'] = $this->model('OrderModel')->countAll();
        $this->data['numberPage'] = $numberPage;
        $this->data['recordsPerPage'] = $recordsPerPage;
        $this->data['currentPage'] = $currentPage;
        $this->render('layouts/admin_layout', $this->data);
    }

    public function update($id)
    {
        if (empty($id)) {
            header('Location: ' . _WEB_ROOT . '/backend/order');
        }

        // Lấy ra thông tin đơn hàng bao gồm: full_name, email, phone_number, status, booking_date, guests_number
        // Du thuyền or khách sạn đã đặt, phòng đặt, số lượng, thêm sửa xóa ...
        $order = $this->model('OrderModel')->getOrderById($id);
        $rooms = $this->model('OrderModel')->getRoomsByOrderId($id);
        $this->data['order'] = $order;
        $this->data['rooms'] = $rooms;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $status = $_POST['status'];
            $booking_date = $_POST['booking_date'];
            $guests_number = $_POST['guests_number'];
            $update = $this->model('OrderModel')->updateOrder($id);
            if ($update) {
                header('Location: ' . _WEB_ROOT . '/backend/order');
            }

            $this->data['full_name'] = $full_name;
            $this->data['email'] = $email;
            $this->data['phone_number'] = $phone_number;
            $this->data['status'] = $status;
            $this->data['booking_date'] = $booking_date;
            $this->data['guests_number'] = $guests_number;
        }

        $this->data['page_title'] = 'Cập nhật thông tin đơn hàng';
        $this->data['layout'] = 'backend/layout.css';
        $this->data['styles'] = [
            'components/toast.min.css',
            'frontend/cruise/style.css',
            'backend/main.css',
        ];
        $this->data['contents'] = [
            'components/admin/sidebar',
            'backend/order/update'
        ];
        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'backend/order/update.js'
        ];
        $this->render('layouts/admin_layout', data: $this->data);
    }
}
