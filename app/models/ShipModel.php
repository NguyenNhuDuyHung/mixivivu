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

    public function countAllCruise() {
        $sql = "SELECT COUNT(*) AS total FROM products WHERE type_product = 1 AND deleted_at IS NULL";
        $total = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }

    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT p.id AS id, p.title AS title, p.address AS address, cr.admin AS admin FROM products p JOIN cruise cr ON cr.id = p.id WHERE p.deleted_at IS NULL ORDER BY p.id ASC LIMIT " . $offset . ", " . $recordsPerPage;

        $ships = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $ships;
    }

    public function getTypeProduct()
    {
        $sql = "SELECT * FROM product_type";
        $product_types = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $product_types;
    }

    public function getPopularCruises()
    {
        $sql = "SELECT p.id AS id, p.title AS title, p.slug AS slug, p.thumbnail AS thumbnail, p.default_price AS price, cr.cabin AS cabin, cr.year AS year, cr.shell AS shell, cc.name AS category_name
            FROM products p JOIN cruise cr 
            ON cr.id = p.id 
            JOIN cruise_category cc 
            ON cr.category_id = cc.id
            WHERE p.active = 1
            ORDER BY p.id ASC 
            LIMIT 6";
        $cruise = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $cruise;
    }

    public function getCruiseBySlug($slug)
    {
        $sql = "SELECT p.id AS id, p.title AS title, 
        p.address AS address, p.map_link AS map_link,
        p.map_iframe_link AS map_iframe_link, p.num_reviews AS num_reviews,
        p.score_review AS score_review, p.slug AS slug, p.thumbnail AS thumbnail, 
        p.images AS images, p.default_price AS price, cr.cabin AS cabin, cr.year AS year, 
        cr.shell AS shell, cr.admin AS admin, cr.trip AS trip, cc.name AS category_name
            FROM products p JOIN cruise cr 
            ON cr.id = p.id 
            JOIN cruise_category cc 
            ON cr.category_id = cc.id
            WHERE p.slug = '$slug'";
        $cruise = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $cruise;
    }

    public function getCruiseLongDesc($id)
    {
        $sql = "SELECT * FROM long_desc WHERE product_id = $id";
        $cruise = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $cruise;
    }

    public function getCruiseShortDesc($id)
    {
        $sql = "SELECT description FROM short_desc WHERE product_id = $id";
        $cruise = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $cruise;
    }

    public function getCruiseRoom($id)
    {
        $sql = "SELECT * FROM rooms WHERE product_id = $id";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function createInfoShip()
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();
            $thumbTargetDir = 'public/img/thumbnail/' . $filterAll['slug'] . '/';
            $imageTargetDir = 'public/img/tour/' . $filterAll['slug'] . '/';

            $thumbUrl = $this->uploadImageToCloudinary($thumbTargetDir, 'thumbnail', 'thumbnail', true);
            $imageUrls = $this->uploadImageToCloudinary($imageTargetDir, 'images',  $filterAll['slug'], true);

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
                'thumbnail' => $thumbUrl,
                'images' => $imageUrls,
                'default_price' => $filterAll['default_price'],
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
                $checkSlug = $this->checkRecord(
                    'products',
                    ['slug'],
                    [$productData['slug']],
                    null,
                    [
                        'slug' => 'Slug đã tồn tại'
                    ]
                );

                if ($checkSlug == false) {
                    return false;
                }

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
            $imagesCruise = $this->findById('products', $id, ['images', 'thumbnail']);

            $filterAll = $this->filter();
            $thumbTargetDir = 'public/img/thumbnail/' . $filterAll['slug'] . '/';
            $imageTargetDir = 'public/img/tour/' . $filterAll['slug'] . '/';

            if (empty($_FILES['thumbnail']['name'][0])) {
                $thumbUrl = $imagesCruise['thumbnail'];
            } else {
                $thumbUrl = $this->uploadImageToCloudinary($thumbTargetDir, 'thumbnail', 'thumbnail', true);
            }

            if (empty($_FILES['images']['name'][0])) {
                $imageUrls = $imagesCruise['images'];
            } else {
                $imageUrls = $this->uploadImageToCloudinary($imageTargetDir, 'images', $filterAll['slug'], true);
                if (!empty($imagesCruise['images'])) {
                    $imageUrls = $imageUrls . ',' . $imagesCruise['images'];
                }
            }

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
                'thumbnail' =>  $thumbUrl,
                'images' => $imageUrls,
                'default_price' => $filterAll['default_price'],
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

                if ($checkSlug == false) {
                    return false;
                }

                $clear = $this->db->query("UPDATE products SET thumbnail = NULL, images = NULL WHERE id = $id");
                if ($clear) {
                    $this->db->update('cruise', $cruiseData, 'id = ' . $id);
                    $this->db->update('products', $productData, 'id = ' . $id);
                    $this->setSession('toast-success', 'Cập nhật thành công!');
                    return true;
                } else {
                    return false;
                }
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

    public function updateProductFeature($productId)
    {
        if ($this->isPost()) {
            if (empty($_POST['features'])) {
                header('Location: ' . _WEB_ROOT . '/backend/ship/update/' . $productId);
            }

            $filterAll = $this->filter();
            $features = $filterAll['features'];
            $data = [
                'feature_id' => $features,
                'product_id' => $productId,
            ];
            try {
                $clearSql = "DELETE FROM product_feature WHERE product_id = " . $productId;
                $clear = $this->db->query($clearSql);

                if (!$clear) {
                    $this->setSession('toast-error', "Có lỗi! Vui lòng thử lại sau!");
                    return false;
                }

                foreach ($data['feature_id'] as $key => $featureId) {
                    $insertData = [
                        'product_id' => $data['product_id'],
                        'feature_id' => $featureId
                    ];
                    $update = $this->db->insert('product_feature', $insertData);
                }

                if ($update) {
                    $this->setSession('toast-success', 'Cập nhật thành công!');
                    return true;
                }
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }
}
