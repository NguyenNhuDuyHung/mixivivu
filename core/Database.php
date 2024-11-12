<?php

class Database
{
    private $__conn;
    function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    function insert($table, $data)
    {
        if (!empty($data)) {
            $fieldStr = '';
            $valueStr = '';

            foreach ($data as $key => $value) {
                $fieldStr .= $key . ',';
                $valueStr .= "'" . $value . "',";
            }

            $fieldStr = rtrim($fieldStr, ',');
            $valueStr = rtrim($valueStr, ',');

            $sql = 'INSERT INTO ' . $table . ' (' . $fieldStr . ') VALUES (' . $valueStr . ')';
            $status = $this->query($sql);

            if ($status) {
                return true;
            }
        }
        return false;
    }

    function update($table, $data, $condition = '')
    {
        if (!empty($data)) {
            $updateStr = '';
            foreach ($data as $key => $value) {
                $updateStr .= $key . ' = "' . $value . '",';
            }

            $updateStr = rtrim($updateStr, ',');

            if (!empty($condition)) {
                $sql = "UPDATE " . $table . " SET " . $updateStr . " WHERE " . $condition;
            } else {
                $sql = "UPDATE " . $table . " SET " . $updateStr;
            }

            $status = $this->query($sql);

            if ($status) {
                return true;
            }

            return false;
        }
    }

    function delete($table, $condition = '')
    {

        if (!empty($condition)) {
            $sql = 'DELETE FROM ' . $table . ' WHERE ' . $condition;
        } else {
            $sql = 'DELETE FROM ' . $table;
        }

        $status = $this->query($sql);

        if ($status) {
            return true;
        }

        return false;
    }

    function query($sql)
    {
        $statement = $this->__conn->prepare($sql);
        $statement->execute();
        return $statement;
    }
    function lastInsertId()
    {
        return $this->__conn->lastInsertId();
    }


    public function insert1($table, $data)
    {
        if (!empty($data)) {
            if (is_array($data['feature_id'])) {
                // Chèn từng cặp product_id và feature_id
                foreach ($data['feature_id'] as $featureId) {
                    // Chuẩn bị dữ liệu cho mỗi feature_id
                    $insertData = [
                        'product_id' => $data['product_id'],
                        'feature_id' => $featureId
                    ];

                    // Tạo chuỗi câu lệnh SQL để chèn dữ liệu vào bảng trung gian
                    $fieldStr = 'product_id, feature_id';
                    $valueStr = "'" . $insertData['product_id'] . "', '" . $insertData['feature_id'] . "'";

                    $sql = 'INSERT INTO ' . $table . ' (' . $fieldStr . ') VALUES (' . $valueStr . ')';
                    echo $sql;
                    die();
                    // Thực thi câu lệnh SQL
                    $status = $this->query($sql);

                    // Nếu có lỗi trong quá trình chèn, trả về false
                    if (!$status) {
                        return false;
                    }
                }

                // Trả về true nếu tất cả các bản ghi đã được chèn thành công
                return true;
            }
        }
        return false;
    }
}
