<?php
class ShipCatalogueModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function search($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT * FROM cruise_category WHERE name LIKE '%$keyword%' LIMIT " . $offset . ", " . $recordsPerPage . " ";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return $data;
    }

    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT * FROM cruise_category LIMIT " . $offset . ", " . $recordsPerPage . " ";

        $ships = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $ships;
    }

    public function create() {}

    public function getCategoryCruise()
    {
        $sql = "SELECT * FROM cruise_category";
        $cruise_categories = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $cruise_categories;
    }

    public function getTypeProduct()
    {
        $sql = "SELECT * FROM product_type";
        $product_types = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $product_types;
    }

    public function createShipCatalogue()
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();
            $data = [
                'name' => $filterAll['name'],
                'image' => $this->handleUploadFile('public/img/ship-category/', 'image', true),
                'created_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $uploadImage = $this->handleUploadFile('public/img/ship-category/', 'image', false);
                $insert = $this->db->insert('cruise_category', $data);
                if ($insert) {
                    $this->setSession('toast-success', 'Tạo thành công!');
                    return true;
                } else {
                    $this->setSession('toast-error', 'Có lỗi xảy ra!');
                    return false;
                }
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }

    public function updateShipCatalogue($id)
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            $data = [
                'name' => $filterAll['name'],
                'image' => $this->handleUploadFile('public/img/ship-category/', 'image', true),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $check = $this->checkRecord(
                    'cruise_category',
                    ['name'],
                    [$data['name']],
                    $id,
                    [
                        'name' => 'Danh mục đã tồn tại'
                    ]
                );

                if ($check == false) {
                    return false;
                }

                $uploadImage = $this->handleUploadFile('public/img/ship-category/', 'image', false);
                $update =  $this->db->update('cruise_category', $data, 'id = ' . $id);
                if ($update) {
                    $this->setSession('toast-success', 'Cập nhật thành công!');
                    return true;
                } else {
                    $this->setSession('toast-error', 'Có lỗi xảy ra!');
                    return false;
                }
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }

    public function deleteShipCatalogue($id)
    {
        try {
            $this->db->delete('cruise_category', 'id = ' . $id);
            $this->setSession('toast-success', 'Xóa thành công!');
            return true;
        } catch (Exception $e) {
            $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return false;
        }
    }
}
