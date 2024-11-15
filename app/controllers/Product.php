<?php
class Product extends Controller
{
    public $data = [];
    public function index()
    {
        echo 'sp';
    }

    public function list_product()
    {
        $dataProduct = $this->model('ProductModel')->getProductLists();
        $title = 'Danh sách sản phẩm';

        $this->data['product_list'] = $dataProduct;
        $this->data['title'] = $title;
        // render view
        $this->render('products/list', $this->data);
    }

    public function detail($id = 0)
    {
        $product = $this->model('ProductModel')->getProductDetails($id);
        $this->data['product']['detail'] = $product;
        $this->data['product']['id'] = $id;
        $this->data['page_title'] = 'Detail';
        $this->data['content'] = 'backend/login';

        $this->render('layouts/client_layout', $this->data);
    }
}