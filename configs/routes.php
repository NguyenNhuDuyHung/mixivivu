<?php
// Ảo (đường dẫn trên url) => Thật (module = ?&action = ?)

$routes['default_controller'] = 'Home';
$routes['login'] = 'auth/login';

$routes['user'] = 'user/index';
$routes['user/create'] = 'user/create';
$routes['user/update/(\d+)'] = 'user/update/$1';
$routes['user/delete/(\d+)'] = 'user/delete/$1';
$routes['user/page/(\d+)'] = 'user/index/$1';

$routes['user/catalogue'] = 'usercatalogue/index';
$routes['user/catalogue/create'] = 'usercatalogue/create';
$routes['user/catalogue/update/(\d+)'] = 'usercatalogue/update/$1';
$routes['user/catalogue/delete/(\d+)'] = 'usercatalogue/delete/$1';
$routes['user/catalogue/page/(\d+)'] = 'usercatalogue/index/$1';


$routes['san-pham'] = 'product/index';
$routes['trang-chu'] = 'home';
$routes['tin-tuc'] = 'news/index';
$routes['tin-tuc/.+-(\d+).html'] = 'news/category/$1';
