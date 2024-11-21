<?php
// Ảo (đường dẫn trên url) => Thật (module = ?&action = ?)

$routes['default_controller'] = 'Home';
$routes['login'] = 'auth/login';

$routes['booking'] = 'booking/index';
$routes['doanh-nghiep'] = 'business/index';

$routes['blog'] = 'blog/index';
$routes['blog-detail/([a-zA-Z0-9-]+)'] = 'blog/detail/$1';

$routes['du-thuyen/([a-zA-Z0-9-]+)'] = 'cruise/index/$1';
$routes['tim-du-thuyen'] = 'cruise/searchpage';
$routes['tim-du-thuyen/search'] = 'cruise/search';
$routes['tim-du-thuyen/page/(\d+)'] = 'cruise/searchpage/$1';

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

$routes['long-desc'] = 'longdesc/index';
$routes['long-desc/search'] = 'longdesc/search';
$routes['long-desc/create'] = 'longdesc/create';
$routes['long-desc/update/(\d+)'] = 'longdesc/update/$1';
$routes['long-desc/delete/(\d+)'] = 'longdesc/delete/$1';
$routes['long-desc/page/(\d+)'] = 'longdesc/index/$1';

$routes['long-desc/catalogue'] = 'longdesccatalogue/index';
$routes['long-desc/catalogue/search'] = 'longdesccatalogue/search';
$routes['long-desc/catalogue/create'] = 'longdesccatalogue/create';
$routes['long-desc/catalogue/update/(\d+)'] = 'longdesccatalogue/update/$1';
$routes['long-desc/catalogue/delete/(\d+)'] = 'longdesccatalogue/delete/$1';
$routes['long-desc/catalogue/page/(\d+)'] = 'longdesccatalogue/index/$1';

$routes['room'] = 'room/index';
$routes['room/search'] = 'room/search';
$routes['room/create'] = 'room/create';
$routes['room/update/(\d+)'] = 'room/update/$1';
$routes['room/update/detail/(\d+)'] = 'room/updateRoomDetails/$1';
$routes['room/delete/(\d+)'] = 'room/delete/$1';
$routes['room/delete/detail/(\d+)'] = 'room/deleteRoomDetails/$1';
$routes['room/page/(\d+)'] = 'room/index/$1';

$routes['hotel'] = 'hotel/index';
$routes['hotel/search'] = 'hotel/search';
$routes['hotel/create'] = 'hotel/create';
$routes['hotel/update/(\d+)'] = 'hotel/update/$1';
$routes['hotel/delete/(\d+)'] = 'hotel/delete/$1';
$routes['hotel/page/(\d+)'] = 'hotel/index/$1';

$routes ['blog'] = 'blog/index';
$routes ['blog/search'] = 'blog/search';
$routes ['blog/create'] = 'blog/create';
$routes ['blog/update/(\d+)'] = 'blog/update/$1';
$routes ['blog/update/long-desc/(\d+)'] = 'blog/updateLongDesc/$1';
$routes ['blog/delete/(\d+)'] = 'blog/delete/$1';
$routes ['blog/page/(\d+)'] = 'blog/index/$1';

$routes ['ve-chung-toi'] = 'footer/aboutus';
$routes ['dieu-khoan-va-dieu-kien'] = 'footer/term';
$routes ['chinh-sach-rieng-tu'] = 'footer/privacy';
$routes ['huong-dan-su-dung'] = 'footer/howtouse';
$routes ['hinh-thuc-thanh-toan'] = 'footer/payment';
$routes ['lien-he'] = 'footer/contact';
$routes ['quy-dinh-chung-va-luu-y'] = 'footer/rules';
$routes ['cau-hoi-thuong-gap'] = 'footer/questions';
$routes ['lien-he'] = 'footer/contact';

$routes['api/cruise/sortWithPrice/([a-zA-Z0-9-]+)'] = 'cruise/sortwithprice/$1';
$routes['api/cruise/sortWithCheckbox/([a-zA-Z0-9-]+)'] = 'cruise/sortwithcheckbox/$1';
