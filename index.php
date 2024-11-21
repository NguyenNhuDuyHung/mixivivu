<?php
// ini_set('display_errors', 0);
// ini_set('log_errors', 1);
// ini_set('error_log', './error.txt');

require_once('./core/phpMailer/Exception.php');
require_once('./core/phpMailer/PHPMailer.php');
require_once('./core/phpMailer/SMTP.php');

date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
require_once 'bootstrap.php';

$app = new App();