<?php
class ShipModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function search($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT p.id AS id, p.title AS title, p.address AS address, cr.admin AS admin
        FROM products p JOIN cruise cr ON cr.id = p.id 
        WHERE p.title LIKE '%" . $keyword . "%' 
        ORDER BY p.id ASC 
        LIMIT " . $offset . ", " . $recordsPerPage;

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return $data;
    }

    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT p.id AS id, p.title AS title, p.address AS address, cr.admin AS admin FROM products p JOIN cruise cr ON cr.id = p.id WHERE p.deleted_at IS NULL ORDER BY p.id ASC LIMIT " . $offset . ", " . $recordsPerPage;

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

    public function createInfoShip()
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();
            $active = $filterAll['type_product'] == "Kích hoạt" ? 1 : 0;
            $typeProduct = $filterAll['type_product'] == "ship" ? 1 : 2;
            $productData = [
                'title' => $filterAll['title'],
                'address' => $filterAll['address'],
                'map_link' => $filterAll['map_link'],
                'map_iframe_link' => $filterAll['map_iframe_link'],
                'schedule' => $filterAll['schedule'],
                'active' => $active,
                'slug' => $filterAll['slug'],
                'type_product' => $typeProduct,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $categoryId = ($filterAll['category_id'] == "Vịnh Hạ Long") ? 1 : (($filterAll['category_id'] == "Vịnh Lan Hạ") ? 2 : 3);
            $cruiseData = [
                'year' => $filterAll['year'],
                'cabin' => $filterAll['cabin'],
                'shell' => $filterAll['shell'],
                'trip' => $filterAll['trip'],
                'admin' => $filterAll['admin'],
                'category_id' => $categoryId,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $insertProduct = $this->db->insert('products', $productData);
                if ($insertProduct) {
                    $newProductId = $this->db->query("SELECT id FROM products ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                    $cruiseData['id'] = $newProductId['id'];

                    $insertCruise = $this->db->insert('cruise', $cruiseData);
                    if ($insertCruise) {
                        $this->setSession('toast-success', 'Cập nhật thành công!');
                        return true;
                    }
                }
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }

    public function updateInfoCruise($id)
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            $active = $filterAll['type_product'] == "Kích hoạt" ? 1 : 0;
            $typeProduct = $filterAll['type_product'] == "ship" ? 1 : 2;
            $productData = [
                'title' => $filterAll['title'],
                'address' => $filterAll['address'],
                'map_link' => $filterAll['map_link'],
                'map_iframe_link' => $filterAll['map_iframe_link'],
                'schedule' => $filterAll['schedule'],
                'active' => $active,
                'slug' => $filterAll['slug'],
                'type_product' => $typeProduct,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $categoryId = ($filterAll['category_id'] == "Vịnh Hạ Long") ? 1 : (($filterAll['category_id'] == "Vịnh Lan Hạ") ? 2 : 3);
            $cruiseData = [
                'shell' => $filterAll['shell'],
                'year' => $filterAll['year'],
                'cabin' => $filterAll['cabin'],
                'trip' => $filterAll['trip'],
                'category_id' => $categoryId,
                'admin' => $filterAll['admin'],
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $checkSlug = $this->checkRecord(
                    'products',
                    ['slug'],
                    [$productData['slug']],
                    $id,
                    [
                        'slug' => 'Slug đã tồn tại'
                    ]
                );

                // if ($checkUser == false) {
                //     return false;
                // } else {

                $this->db->update('cruise', $cruiseData, 'id = ' . $id);
                $this->db->update('products', $productData, 'id = ' . $id);
                $this->setSession('toast-success', 'Cập nhật thành công!');
                return true;
                // }
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }

    public function deleteCruise($id)
    {
        try {
            $this->db->delete('products', 'id = ' . $id);
            $this->setSession('toast-success', 'Xóa thành công!');
            return true;
        } catch (Exception $e) {
            $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return false;
        }
    }
}
