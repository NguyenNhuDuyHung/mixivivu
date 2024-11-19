<?php
class Cruise extends Controller
{
    public $model;
    public $data = [];
    public function __construct()
    {
        $this->model = new Model();
    }

    public function index($slug)
    {
        $cruise = $this->model('ShipModel')->getCruiseBySlug($slug);
        $cruiseImages = explode(',', $cruise['images']);
        // $cruiseImages = array_chunk($cruiseImages, 3);
        $cruiseFeatures = $this->model->findById('product_feature', $cruise['id'], ['icon', 'text'], [
            'features f' => 'f.id = product_feature.feature_id',
            'products p' => 'p.id = product_feature.product_id',
        ], 'product_id', true);
        $cruiseShortDescs = $this->model('ShipModel')->getCruiseShortDesc($cruise['id']);
        $cruiseLongDescs = $this->model('ShipModel')->getCruiseLongDesc($cruise['id']);
        $cruiseRooms = $this->model("ShipModel")->getCruiseRoom($cruise['id']);

        $this->data['cruise'] = $cruise;
        $this->data['cruiseImages'] = $cruiseImages;
        $this->data['cruiseFeatures'] = $cruiseFeatures;
        $this->data['cruiseShortDescs'] = array_column($cruiseShortDescs, 'description');
        $this->data['cruiseLongDescs'] = $cruiseLongDescs;
        $this->data['cruiseRooms'] = $cruiseRooms;
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/cruise/index',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/cruise/style.css',
        ];

        $this->data['scripts'] = [
            'components/toast.min.js',
            'components/toast.js',
            'frontend/cruise/main.js',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }
}
