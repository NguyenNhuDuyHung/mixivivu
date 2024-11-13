<?php

use GuzzleHttp\Client;
use GuzzleHttp\Promise;

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

    private function checkColumnExist($table, $column)
    {
        $sql = "SHOW COLUMNS FROM " . $table . " LIKE '" . $column . "'";
        $result = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return !empty($result);
    }

    private function handleSqlForCount($table, $keyword = null, array $fields = [])
    {
        $sql = "SELECT COUNT(*) AS total FROM " . $table;
        $checkColumnExist = $this->checkColumnExist($table, 'deleted_at');

        if ($checkColumnExist) {
            $sql .= " WHERE deleted_at IS NULL";
        }

        if ($keyword && !empty($fields)) {
            $conditions = [];
            foreach ($fields as $field) {
                $conditions[] = $field . " LIKE '%" . $keyword . "%'";
            }
            if (str_contains($sql, 'WHERE')) {
                $sql .= " AND " . '(' . implode(" OR ", $conditions) . ')';
            } else {
                $sql .= " WHERE " . implode(" OR ", $conditions);
            }
        }

        return $sql;
    }

    public function findById($table, int $id, array $fields = ['*'], array $joins = [], $primaryKey = 'id', $option = false)
    {
        $sql = "SELECT " . implode(', ', $fields) . " FROM " . $table;

        if (!empty($joins)) {
            foreach ($joins as $joinTable => $joinCondition) {
                $sql .= " JOIN " . $joinTable . " ON " . $joinCondition;
            }
        }

        $tableParts = explode(" ", $table);
        if (count($tableParts) > 1) {
            $alias = end(array: $tableParts); // Lấy phần sau dấu " "
            $sql .= " WHERE " . $alias . "." . $primaryKey . " = " . $id;
        } else {
            $sql .= " WHERE " . $primaryKey . " = " . $id;
        }

        if ($option) {
            $result = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        $result = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function checkRecord($table, array $fields, array $values, $id = null, array $customErrorMessages = [])
    {
        $conditions = [];
        foreach ($fields as $index => $field) {
            $condition = $field . " = '" . $values[$index] . "'";
            if (!empty($id)) {
                $condition .= " AND id != $id";
            }
            $conditions[] = $condition;
        }

        $sql = "SELECT * FROM " . $table . " WHERE " . implode(" OR ", $conditions);
        $result = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            foreach ($fields  as $index => $field) {
                if ($result[$field] == $values[$index]) {
                    $errorMessage = isset($customErrorMessages[$field]) ? $customErrorMessages[$field] : ucfirst($field) . ' đã tồn tại! ';
                    $this->setSession('toast-error', $errorMessage);
                    return false;
                }
            }
        }
        return true;
    }

    public function checkRecordExist($table, $field, $value)
    {
        $sql = "SELECT COUNT(*) AS total FROM " . $table . " WHERE " . $field . " = '" . $value . "'";

        $result = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    }

    public function countPages($recordsPerPage, $table, $keyword = null, array $fields = [])
    {
        $sql = $this->handleSqlForCount($table, $keyword, $fields);
        $total = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);

        return ceil($total['total'] / $recordsPerPage);
    }

    public function countPagesDistinct($recordsPerPage, $table, $keyword = null, array $fieldsDistinct = [], array $fields = [])
    {
        $sql = "SELECT COUNT(DISTINCT " . implode(', ', $fieldsDistinct) . ") AS total FROM " . $table;

        if($keyword) {
            $sql .= " WHERE " . implode(' OR ', $fields) . " LIKE '%" . $keyword . "%'";
        }
        $total = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return ceil($total['total'] / $recordsPerPage);
    }

    public function countAllOrByKeyword($table, $keyword = null, array $fields = [])
    {
        $sql = $this->handleSqlForCount($table, $keyword, $fields);
        $total = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }

    public function countAllDistinct($table, $keyword = null, array $fields = [])
    {
        $sql = "SELECT COUNT(DISTINCT " . implode(', ', $fields) . ") AS total FROM " . $table;
        if ($keyword) {
            $sql .= " WHERE " . implode(' OR ', $fields) . " LIKE '%" . $keyword . "%'";
        }
        $total = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }

    public function handleUploadFile($targetDir, $file, $option = false)
    {
        $uploadedFiles = [];
        if (!empty($_FILES[$file]['tmp_name']) && !empty($_FILES[$file]['name'])) {
            $flag = true;
            $files_array = array_combine($_FILES[$file]['tmp_name'], $_FILES[$file]['name']);

            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            foreach ($files_array as $tmp_name => $name) {
                $target_file = $targetDir . basename($name);
                if (move_uploaded_file($tmp_name, $target_file)) {
                    // $this->setSession('toast-success', 'Upload file ' . $name . ' thành công!');
                    $uploadedFiles[] = $target_file;
                } else {
                    $flag = false;
                    // $this->setSession('toast-error', 'Có lỗi xảy ra khi upload file ' . $name . '!');
                    return $flag;
                }
            }
        }

        if ($option) {
            return implode(',', $uploadedFiles);
        }
    }

    public function uploadImageToCloudinary($targetDir, $file, $folder)
    {
        $client = new Client();
        $promises = [];

        $makeFile = $this->handleUploadFile($targetDir, $file, false);

        foreach ($_FILES[$file]['name'] as $key => $name) {
            $filepath = $targetDir . $_FILES[$file]['name'][$key];

            $multipart = [
                'multipart' => array_merge(
                    [
                        [
                            'name' => 'public_id',
                            'contents' => $name
                        ],
                        [
                            'name' => 'file',
                            'contents' => fopen($filepath, 'r'),
                        ],
                        [
                            'name'     => 'upload_preset',
                            'contents' => 'mixivivu',
                        ],
                        [
                            'name'     => 'folder',
                            'contents' => 'mixivivu',
                        ],
                        [
                            'name'     => 'folder',
                            'contents' => $folder,
                        ]
                    ],
                )
            ];

            $promises[] = $client->postAsync('https://api.cloudinary.com/v1_1/' . _CLOUDINARY_CLOUD_NAME . '/upload', $multipart);
        }

        $responses = Promise\Utils::settle($promises)->wait();

        $urls = [];
        foreach ($responses as $response) {
            if ($response['state'] === 'fulfilled') {
                // Thành công, lấy URL
                $result = $response['value']->getBody();
                $json = json_decode($result, true);

                if (isset($json['secure_url'])) {
                    $fileUrl = $json['secure_url'];
                    $urls[] = $fileUrl;
                }
            } else {
                // Thất bại, xử lý lỗi
                $error = $response['reason'];
                echo 'Error: ' . $error;
            }
        }

        $urls = implode(",", $urls);
        return $urls;
    }
}
