<?php
$routes['default_controller'] = 'Home';
$routes['login'] = 'auth/login';

// 
$routes['san-pham'] = 'product/index';
$routes['trang-chu'] = 'home';
$routes['tin-tuc/.+-(\d+).html'] = 'news/category/$1';