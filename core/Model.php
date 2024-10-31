<?php

class Model extends Database
{
    protected $db;
    function __construct()
    {
        $this->db = new Database();
    }

    function isGet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            return true;
        }
        return false;
    }

    function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        }
        return false;
    }

    function filter()
    {
        $filterArr = []; // mảng rỗng để lưu các giá trị đã lọc
        if ($this->isGet()) {
            // $_GET: các tham số được truyền qua url
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    $key = strip_tags($key); // Loại bỏ các tag html: ngăn tấn công XSS
                    if (is_array($value)) {
                        $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY); // FILTER_REQUIRE_ARRAY: Mảng bắt buộc phải được lọc
                    } else {
                        $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS); // FILTER_SANITIZE_SPECIAL_CHARS: Chuyển các ký tự đặc biệt thành mã an toàn để chặn mã độc
                    }
                }
            }
        }

        if ($this->isPost()) {
            // Xử lý dữ liệu trước khi nó được hiển thị
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        return $filterArr;
    }

    function setSession($key, $value, $time = 0)
    {
        if ($time == 0) {
            $_SESSION[$key] = $value;
            return $_SESSION;
        } else {
            $_SESSION[$key] = $value;
            $_SESSION['time'] = time() + $time;
            return $_SESSION;
        }
    }

    // Hàm đọc session
    function getSession($key = '')
    {
        if (!empty($key)) {
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            }
        } else {
            return $_SESSION;
        }
    }

    // Hàm xóa session
    function removeSession($key = '')
    {
        if (!empty($key)) {
            if (isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
                return true;
            }
        } else {
            session_destroy();
            return true;
        }
    }

    function checkSesstionTimeOut($key)
    {
        if (isset($_SESSION['time'])) {
            if ($_SESSION['time'] < time()) {
                $this->removeSession($key);
                return true;
            }
        }
    }
    // Hàm flash data: Sau khi xử dụng xong trong 1 phiên làm việc sẽ tự động xóa 
    function setFlashData($key, $value)
    {
        // Phân biệt key của session thường và key của flashdata
        $key = 'flash_' . $key;
        return $this->setSession($key, $value);
    }

    // Hàm đọc flash data
    function getFlashData($key)
    {
        $key = 'flash_' . $key;
        $data = $this->getSession($key);
        $this->removeSession($key);
        return $data;
    }

    function oldInfo($fileName, $oldData, $default = null)
    {
        return (!empty($oldData[$fileName])) ? $oldData[$fileName] : $default;
    }

    function formError($fileName, $errors)
    {
        return (!empty($errors[$fileName])) ? $errors[$fileName] : null;
    }

    public function isLogin()
    {
        $checkLogin = false;

        $token = $_SESSION['loginToken'] ?? $_COOKIE['loginToken'] ?? null;

        if ($token) {
            $queryToken = $this->db->query("SELECT user_id FROM tokenlogin WHERE token = '$token'")->fetch(PDO::FETCH_ASSOC);

            if (!empty($queryToken)) {
                $checkLogin = true;
                if (!isset($_SESSION['loginToken'])) {
                    $_SESSION['loginToken'] = $token;
                }
            } else {
                setcookie('loginToken', '', time() - 3600, "/");
            }
        }

        return $checkLogin;
    }
}