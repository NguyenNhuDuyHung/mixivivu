<?php
require 'vendor/autoload.php';

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

define('_CLOUDINARY_CLOUD_NAME', 'dhnp8ymxv');
define('_CLOUDINARY_API_KEY', '141873257857924');
define('_CLOUDINARY_API_SECRET', '3B7zb5-juOv0z3TwOTd2w47DuwQ');

Configuration::instance([
    'cloud' => [
        'cloud_name' => _CLOUDINARY_CLOUD_NAME,
        'api_key'    => _CLOUDINARY_API_KEY,
        'api_secret' => _CLOUDINARY_API_SECRET
    ],
    'url' => [
        'secure' => true
    ]
]);
