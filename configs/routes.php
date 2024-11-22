<?php
// Ảo (đường dẫn trên url) => Thật (module = ?&action = ?)

$routes['default_controller'] = 'Home';
$routes['login'] = 'auth/login';

$routes['order'] = 'order/index';
$routes['order/search'] = 'order/search';
$routes['order/update/(\d+)'] = 'order/update/$1';
$routes['order/delete/(\d+)'] = 'order/delete/$1';
$routes['order/page/(\d+)'] = 'order/index/$1';

$routes['user'] = 'user/index';
$routes['user/search'] = 'user/search';
$routes['user/create'] = 'user/create';
$routes['user/update/(\d+)'] = 'user/update/$1';
$routes['user/delete/(\d+)'] = 'user/delete/$1';
$routes['user/page/(\d+)'] = 'user/index/$1';

$routes['user/catalogue'] = 'UserCatalogue/index';
$routes['user/catalogue/search'] = 'UserCatalogue/search';
$routes['user/catalogue/create'] = 'UserCatalogue/create';
$routes['user/catalogue/update/(\d+)'] = 'UserCatalogue/update/$1';
$routes['user/catalogue/delete/(\d+)'] = 'UserCatalogue/delete/$1';
$routes['user/catalogue/page/(\d+)'] = 'UserCatalogue/index/$1';

$routes['ship'] = 'ship/index';
$routes['ship/search'] = 'ship/search';
$routes['ship/create'] = 'ship/create';
$routes['ship/update/(\d+)'] = 'ship/update/$1';
$routes['ship/delete/(\d+)'] = 'ship/delete/$1';
$routes['ship/page/(\d+)'] = 'ship/index/$1';

$routes['ship/catalogue'] = 'ShipCatalogue/index';
$routes['ship/catalogue/search'] = 'ShipCatalogue/search';
$routes['ship/catalogue/create'] = 'ShipCatalogue/create';
$routes['ship/catalogue/update/(\d+)'] = 'ShipCatalogue/update/$1';
$routes['ship/catalogue/delete/(\d+)'] = 'ShipCatalogue/delete/$1';
$routes['ship/catalogue/page/(\d+)'] = 'ShipCatalogue/index/$1';

$routes['feature'] = 'Feature/index';
$routes['feature/search'] = 'Feature/search';
$routes['feature/create'] = 'Feature/create';
$routes['feature/update/(\d+)'] = 'Feature/update/$1';
$routes['feature/delete/(\d+)'] = 'Feature/delete/$1';
$routes['feature/page/(\d+)'] = 'Feature/index/$1';
$routes['ship/feature/(\d+)'] = 'ship/Feature/$1';

$routes['feature/catalogue'] = 'FeatureCatalogue/index';
$routes['feature/catalogue/search'] = 'FeatureCatalogue/search';
$routes['feature/catalogue/create'] = 'FeatureCatalogue/create';
$routes['feature/catalogue/update/(\d+)'] = 'FeatureCatalogue/update/$1';
$routes['feature/catalogue/delete/(\d+)'] = 'FeatureCatalogue/delete/$1';
$routes['feature/catalogue/page/(\d+)'] = 'FeatureCatalogue/index/$1';

$routes['short-desc'] = 'ShortDesc/index';
$routes['short-desc/search'] = 'ShortDesc/search';
$routes['short-desc/create'] = 'ShortDesc/create';
$routes['short-desc/update/(\d+)'] = 'ShortDesc/update/$1';
$routes['short-desc/delete/(\d+)'] = 'ShortDesc/delete/$1';
$routes['short-desc/page/(\d+)'] = 'ShortDesc/index/$1';

$routes['long-desc'] = 'LongDesc/index';
$routes['long-desc/search'] = 'LongDesc/search';
$routes['long-desc/create'] = 'LongDesc/create';
$routes['long-desc/update/(\d+)'] = 'LongDesc/update/$1';
$routes['long-desc/delete/(\d+)'] = 'LongDesc/delete/$1';
$routes['long-desc/page/(\d+)'] = 'LongDesc/index/$1';

$routes['long-desc/catalogue'] = 'LongDescCatalogue/index';
$routes['long-desc/catalogue/search'] = 'LongDescCatalogue/search';
$routes['long-desc/catalogue/create'] = 'LongDescCatalogue/create';
$routes['long-desc/catalogue/update/(\d+)'] = 'LongDescCatalogue/update/$1';
$routes['long-desc/catalogue/delete/(\d+)'] = 'LongDescCatalogue/delete/$1';
$routes['long-desc/catalogue/page/(\d+)'] = 'LongDescCatalogue/index/$1';

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

$routes['blog'] = 'blog/index';
$routes['blog/search'] = 'blog/search';
$routes['blog/create'] = 'blog/create';
$routes['blog/update/(\d+)'] = 'blog/update/$1';
$routes['blog/update/long-desc/(\d+)'] = 'blog/updateLongDesc/$1';
$routes['blog/delete/(\d+)'] = 'blog/delete/$1';
$routes['blog/page/(\d+)'] = 'blog/index/$1';

$routes['ve-chung-toi'] = 'footer/aboutus';
$routes['dieu-khoan-va-dieu-kien'] = 'footer/term';
$routes['chinh-sach-rieng-tu'] = 'footer/privacy';
$routes['huong-dan-su-dung'] = 'footer/howtouse';
$routes['hinh-thuc-thanh-toan'] = 'footer/payment';
$routes['lien-he'] = 'footer/contact';
$routes['quy-dinh-chung-va-luu-y'] = 'footer/rules';
$routes['cau-hoi-thuong-gap'] = 'footer/questions';
$routes['lien-he'] = 'footer/contact';

$routes['api/cruise/sortWithPrice/([a-zA-Z0-9-]+)'] = 'cruise/sortwithprice/$1';
$routes['api/cruise/sortWithCheckbox/([a-zA-Z0-9-]+)'] = 'cruise/sortwithcheckbox/$1';


$routes['booking'] = 'booking/index';
$routes['booking/hotel'] = 'booking/hotel';
$routes['doanh-nghiep'] = 'business/index';

$routes['blog'] = 'blog/index';
$routes['blog-detail/([a-zA-Z0-9-]+)'] = 'blog/detail/$1';

$routes['du-thuyen/([a-zA-Z0-9-]+)'] = 'cruise/index/$1';
$routes['tim-du-thuyen'] = 'cruise/searchPage';
$routes['tim-du-thuyen/search'] = 'cruise/search';
$routes['tim-du-thuyen/page/(\d+)'] = 'cruise/searchPage/$1';


$routes['khach-san'] = 'hotel/index';
$routes['khach-san/([a-zA-Z0-9-]+)'] = 'hotel/detail/$1';
