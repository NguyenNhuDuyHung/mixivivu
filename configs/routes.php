<?php
// Ảo (đường dẫn trên url) => Thật (module = ?&action = ?)

$routes['default_controller'] = 'Home';
$routes['login'] = 'auth/login';

$routes['user'] = 'user/index';
$routes['user/search'] = 'user/search';
$routes['user/create'] = 'user/create';
$routes['user/update/(\d+)'] = 'user/update/$1';
$routes['user/delete/(\d+)'] = 'user/delete/$1';
$routes['user/page/(\d+)'] = 'user/index/$1';

$routes['user/catalogue'] = 'usercatalogue/index';
$routes['user/catalogue/search'] = 'usercatalogue/search';
$routes['user/catalogue/create'] = 'usercatalogue/create';
$routes['user/catalogue/update/(\d+)'] = 'usercatalogue/update/$1';
$routes['user/catalogue/delete/(\d+)'] = 'usercatalogue/delete/$1';
$routes['user/catalogue/page/(\d+)'] = 'usercatalogue/index/$1';

$routes['ship'] = 'ship/index';
$routes['ship/search'] = 'ship/search';
$routes['ship/create'] = 'ship/create';
$routes['ship/update/(\d+)'] = 'ship/update/$1';
$routes['ship/delete/(\d+)'] = 'ship/delete/$1';
$routes['ship/page/(\d+)'] = 'ship/index/$1';

$routes['ship/catalogue'] = 'shipcatalogue/index';
$routes['ship/catalogue/search'] = 'shipcatalogue/search';
$routes['ship/catalogue/create'] = 'shipcatalogue/create';
$routes['ship/catalogue/update/(\d+)'] = 'shipcatalogue/update/$1';
$routes['ship/catalogue/delete/(\d+)'] = 'shipcatalogue/delete/$1';
$routes['ship/catalogue/page/(\d+)'] = 'shipcatalogue/index/$1';

$routes['feature'] = 'feature/index';
$routes['feature/search'] = 'feature/search';
$routes['feature/create'] = 'feature/create';
$routes['feature/update/(\d+)'] = 'feature/update/$1';
$routes['feature/delete/(\d+)'] = 'feature/delete/$1';
$routes['feature/page/(\d+)'] = 'feature/index/$1';
$routes['ship/feature/(\d+)'] = 'ship/feature/$1';

$routes['feature/catalogue'] = 'featurecatalogue/index';
$routes['feature/catalogue/search'] = 'featurecatalogue/search';
$routes['feature/catalogue/create'] = 'featurecatalogue/create';
$routes['feature/catalogue/update/(\d+)'] = 'featurecatalogue/update/$1';
$routes['feature/catalogue/delete/(\d+)'] = 'featurecatalogue/delete/$1';
$routes['feature/catalogue/page/(\d+)'] = 'featurecatalogue/index/$1';

$routes['short-desc'] = 'shortdesc/index';
$routes['short-desc/search'] = 'shortdesc/search';
$routes['short-desc/create'] = 'shortdesc/create';
$routes['short-desc/update/(\d+)'] = 'shortdesc/update/$1';
$routes['short-desc/delete/(\d+)'] = 'shortdesc/delete/$1';
$routes['short-desc/page/(\d+)'] = 'shortdesc/index/$1';

$routes['trang-chu'] = 'home';
$routes['tin-tuc'] = 'news/index';
$routes['tin-tuc/.+-(\d+).html'] = 'news/category/$1';
