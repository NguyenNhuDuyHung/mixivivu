<?php

class Hotel extends Controller
{
    public $model;
    public $data = [];
    public function __construct()
    {
        $this->model = new Model();
    }
    public function index()
    {
        $cities = $this->model("HotelModel")->getAllCity();
        $popularHotels = $this->model('HotelModel')->getPopularHotels();
        $cityActive = $this->model("HotelModel")->getCityActive();
        $this->data['cities'] = $cities;
        $this->data['popularHotels'] = $popularHotels;
        $this->data['cityActive'] = $cityActive;

        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/hotel/index',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/home/style.css',
        ];

        $this->data['scripts'] = [
            'frontend/home/main.js',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }

    public function detail($slug)
    {
        $hotel = $this->model('HotelModel')->getHotelBySlug($slug);
        $hotelImages = explode(',', $hotel['images']);
        $hotelFeatures = $this->model->findById('hotel_feature', $hotel['id'], ['icon', 'text'], [
            'features f' => 'f.id = hotel_feature.feature_id',
            'hotel h' => 'h.id = hotel_feature.hotel_id',
        ], 'hotel_id', true);
        $hotelShortDescs = $this->model('HotelModel')->getHotelShortDesc($hotel['id']);
        $hotelLongDescs = $this->model('HotelModel')->getHotelLongDesc($hotel['id']);
        $hotelRooms = $this->model("HotelModel")->getHotelRoom($hotel['id']);
        $this->data['hotel'] = $hotel;
        $this->data['hotelImages'] = $hotelImages;
        $this->data['hotelFeatures'] = $hotelFeatures;
        $this->data['hotelShortDescs'] = array_column($hotelShortDescs, 'description');
        $this->data['hotelLongDescs'] = $hotelLongDescs;
        $this->data['hotelRooms'] = $hotelRooms;
        $this->data['page_title'] = 'Mixivivu';
        $this->data['header'] = 'components/client/header';
        $this->data['footer'] = 'components/client/footer';
        $this->data['contents'] = [
            'frontend/hotel/detail',
        ];
        $this->data['layout'] = 'frontend/layout.css';
        $this->data['styles'] = [
            'frontend/cruise/style.css',
        ];

        $this->data['scripts'] = [
            'frontend/hotel/main.js',
        ];

        $this->render('layouts/client_layout', data: $this->data);
    }
}
