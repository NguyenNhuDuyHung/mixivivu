<?php
class DescriptionModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function countPageShortDescSearch($keyword, $recordsPerPage)
    {
        $sql = "SELECT COUNT(*) AS total
            FROM (
                SELECT p.id
                FROM products p
                JOIN short_desc sd ON p.id = sd.product_id
                WHERE p.title LIKE '%" . $keyword . "%'
                GROUP BY p.id
            ) AS subquery";

        $total = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return ceil($total['total'] / $recordsPerPage);
    }

    public function countAllShortDescSearch($keyword)
    {
        $sql = "SELECT COUNT(*) AS total
            FROM (
                SELECT p.id
                FROM products p
                JOIN short_desc sd ON p.id = sd.product_id
                WHERE p.title LIKE '%" . $keyword . "%'
                GROUP BY p.id
            ) AS subquery";

        $total = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }

    public function searchShortDesc($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT p.id, p.title, GROUP_CONCAT(sd.description SEPARATOR ', ') AS descriptions, COUNT(sd.description) AS countDesc
        FROM products p
        JOIN short_desc sd ON p.id = sd.product_id
        WHERE p.title LIKE '%" . $keyword . "%'
        GROUP BY p.id   
        LIMIT " . $offset . ", " . $recordsPerPage . " ";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return $data;
    }

    public function paginationShortDesc($offset, $recordsPerPage)
    {
        $sql = "SELECT p.id, p.title, GROUP_CONCAT(sd.description SEPARATOR ', ') AS descriptions, COUNT(sd.description) AS countDesc
        FROM products p
        JOIN short_desc sd ON p.id = sd.product_id
        GROUP BY p.id   
        ORDER BY p.id DESC
        LIMIT " . $offset . ", " . $recordsPerPage . " ";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getProduct()
    {
        $sql = "SELECT id, title FROM products";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function createShortDesc()
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            $data = [
                'description' => $filterAll['description'],
                'product_id' => $filterAll['product_id'],
            ];

            try {
                foreach ($data['description'] as $key => $value) {
                    $insertData = [
                        'product_id' => $data['product_id'],
                        'description' => $value,
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                    $create = $this->db->insert('short_desc', $insertData);
                }
                if (!$create) {
                    $this->setSession('toast-error', 'Thêm không thành công! Vui lòng thử lại sau!');
                    return false;
                }
                $this->setSession('toast-success', 'Thêm thành công!');
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function updateShortDesc($id)
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            if (empty($_POST['description'])) {
                $this->setSession('toast-error', 'Có lỗi!');
                return false;
            }

            $data = [
                'description' => $filterAll['description'],
                'product_id' => $filterAll['product_id'],
            ];

            try {
                $clear = $this->db->delete('short_desc', 'product_id = ' . $id);
                if (!$clear) {
                    $this->setSession('toast-error', 'Có lỗi! Vui lòng thử lại sau!');
                    return false;
                }

                foreach ($data['description'] as $key => $value) {
                    $insertData = [
                        'product_id' => $data['product_id'],
                        'description' => $value,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    $update = $this->db->insert('short_desc', $insertData);
                }

                if (!$update) {
                    $this->setSession('toast-error', 'Cập nhật không thành công! Vui lòng thử lại sau!');
                    return false;
                }

                $this->setSession('toast-success', 'Cập nhật thành công!');
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function deleteShortDesc($id)
    {
        try {
            $delete = $this->db->delete('short_desc', 'product_id = ' . $id);
            if (!$delete) {
                $this->setSession('toast-error', 'Xóa không thành công! Vui lòng thử lại sau!');
                return false;
            }
            $this->setSession('toast-success', 'Xóa thành công!');
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
