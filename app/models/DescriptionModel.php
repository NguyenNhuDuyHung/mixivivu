<?php
class DescriptionModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function searchShortDesc($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT sd.id, sd.description, p.title FROM short_desc sd JOIN products p ON sd.product_id = p.id WHERE sd.description LIKE '%" . $keyword . "%' OR p.title LIKE '%" . $keyword . "%' LIMIT " . $offset . ", " . $recordsPerPage . " ";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function paginationShortDesc($offset, $recordsPerPage)
    {
        $sql = "SELECT sd.id, sd.description, p.title FROM short_desc sd JOIN products p ON sd.product_id = p.id LIMIT " . $offset . ", " . $recordsPerPage . " ";

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
                'created_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $create = $this->db->insert('short_desc', $data);
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

            $data = [
                'description' => $filterAll['description'],
                'product_id' => $filterAll['product_id'],
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $update = $this->db->update('short_desc', $data, 'id = ' . $id);
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
            $delete = $this->db->delete('short_desc', 'id = ' . $id);
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
