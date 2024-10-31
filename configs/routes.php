<?php
// Ảo => Thật

$routes['default_controller'] = 'Home';
$routes['login'] = 'auth/login';

$routes['user'] = 'user/index';
$routes['user/page/(\d+)'] = 'user/index/$1';
$routes['user/create'] = 'user/create';
$routes['user/update/(\d+)'] = 'user/update/$1';
$routes['user/delete/(\d+)'] = 'user/delete/$1';
$routes['san-pham'] = 'product/index';
$routes['trang-chu'] = 'home';
$routes['tin-tuc'] = 'news/index';
$routes['tin-tuc/.+-(\d+).html'] = 'news/category/$1';