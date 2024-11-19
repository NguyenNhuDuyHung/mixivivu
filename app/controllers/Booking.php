<?php
class Booking extends Controller
{
    public $model;
    public $data = [];
    public function __construct()
    {
        $this->model = new Model();
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $createOrder = $this->model('BookingModel')->createOrder();
            if ($createOrder) {
                $previousPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : _WEB_ROOT;
                header('Location: ' . $previousPage);
            }
        }
    }
}
