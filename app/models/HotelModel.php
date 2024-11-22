<?php
class HotelModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function search($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT p.id AS id, p.title AS title, p.address AS address, h.admin AS admin FROM products p 
        JOIN hotel h ON h.id = p.id WHERE p.title LIKE '%" . $keyword . "%' ORDER BY p.id DESC LIMIT " . $offset . ", " . $recordsPerPage;
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT p.id AS id, p.title AS title, p.address AS address, h.admin AS admin FROM products p 
        JOIN hotel h ON h.id = p.id ORDER BY p.id DESC LIMIT " . $offset . ", " . $recordsPerPage;
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getAllCity()
    {
        $sql = "SELECT * FROM cities";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function createInfoHotel()
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();
            $thumbTargetDir = 'public/img/thumbnail/' . $filterAll['slug'] . '/';
            $imageTargetDir = 'public/img/hotel/' . $filterAll['slug'] . '/';

            $thumbUrl = $this->uploadImageToCloudinary($thumbTargetDir, 'thumbnail', 'thumbnail', true);
            $imageUrls = $this->uploadImageToCloudinary($imageTargetDir, 'images',  $filterAll['slug'], true);

            $active = $filterAll['active'] == "Kích hoạt" ? 1 : 0;
            $typeProduct = 2;
            $productData = [
                'title' => $filterAll['title'],
                'address' => $filterAll['address'],
                'map_link' => $filterAll['map_link'],
                'map_iframe_link' => $filterAll['map_iframe_link'],
                'active' => $active,
                'slug' => $filterAll['slug'],
                'type_product' => $typeProduct,
                'thumbnail' => $thumbUrl,
                'images' => $imageUrls,
                'default_price' => $filterAll['default_price'],
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $hotelData = [
                'admin' => $filterAll['admin'],
                'city_id' => $filterAll['city_id'],
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

                $insert = $this->db->insert('products', $productData);
                if (!$insert) {
                    $this->setSession('toast-error', 'Có lỗi xảy ra');
                    return false;
                }

                $newProductId = $this->db->query("SELECT id FROM products ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                $hotelData['id'] = $newProductId['id'];

                $insertHotel = $this->db->insert('hotel', $hotelData);

                if (!$insertHotel) {
                    $this->setSession('toast-error', 'Có lỗi xảy ra');
                    return false;
                }

                $hotelFeature = [
                    'hotel_id' => $newProductId['id'],
                    'feature_id' => $filterAll['hotelFeatures'],
                ];

                foreach ($hotelFeature['feature_id'] as $key => $featureId) {
                    $insertData = [
                        'hotel_id' => $hotelFeature['hotel_id'],
                        'feature_id' => $featureId
                    ];
                    $insertFeature = $this->db->insert('hotel_feature', $insertData);
                }

                if (!$insertFeature) {
                    $this->setSession('toast-error', 'Có lỗi xảy ra');
                    return false;
                }

                $this->setSession('toast-success', 'Cập nhật thành công!');
                return true;
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }

    public function updateInfoHotel($id)
    {
        if ($this->isPost()) {
            $imagesHotel = $this->findById('products', $id, ['images', 'thumbnail']);

            $filterAll = $this->filter();
            $thumbTargetDir = 'public/img/thumbnail/' . $filterAll['slug'] . '/';
            $imageTargetDir = 'public/img/hotel/' . $filterAll['slug'] . '/';

            if (empty($_FILES['thumbnail']['name'][0])) {
                $thumbUrl = $imagesHotel['thumbnail'];
            } else {
                $thumbUrl = $this->uploadImageToCloudinary($thumbTargetDir, 'thumbnail', 'thumbnail', true);
            }

            if (empty($_FILES['images']['name'][0])) {
                $imageUrls = $imagesHotel['images'];
            } else {
                $imageUrls = $this->uploadImageToCloudinary($imageTargetDir, 'images', $filterAll['slug'], true);
                if (!empty($imagesHotel['images'])) {
                    $imageUrls = $imageUrls . ',' . $imagesHotel['images'];
                }
            }

            $active = $filterAll['active'] == "Kích hoạt" ? 1 : 0;
            $typeProduct = 2;

            $productData = [
                'title' => $filterAll['title'],
                'address' => $filterAll['address'],
                'map_link' => $filterAll['map_link'],
                'map_iframe_link' => $filterAll['map_iframe_link'],
                'active' => $active,
                'slug' => $filterAll['slug'],
                'type_product' => $typeProduct,
                'thumbnail' => $thumbUrl,
                'images' => $imageUrls,
                'default_price' => $filterAll['default_price'],
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $hotelData = [
                'admin' => $filterAll['admin'],
                'city_id' => $filterAll['city_id'],
                'created_at' => date('Y-m-d H:i:s'),
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
                    $this->db->update('hotel', $hotelData, 'id = ' . $id);
                    $this->db->update('products', $productData, 'id = ' . $id);

                    $clearFeature = $this->db->delete('hotel_feature', 'hotel_id = ' . $id);
                    if (!$clearFeature) {
                        $this->setSession('toast-error', 'Có lỗi xảy ra');
                        return false;
                    }

                    $hotelFeature = [
                        'hotel_id' => $id,
                        'feature_id' => $filterAll['hotelFeatures'],
                    ];

                    foreach ($hotelFeature['feature_id'] as $key => $featureId) {
                        $insertData = [
                            'hotel_id' => $hotelFeature['hotel_id'],
                            'feature_id' => $featureId
                        ];
                        $insertFeature = $this->db->insert('hotel_feature', $insertData);
                    }

                    if (!$insertFeature) {
                        $this->setSession('toast-error', 'Có lỗi xảy ra');
                        return false;
                    }

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

    public function deleteHotel($id): bool
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

    public function getPopularHotels()
    {
        $sql = "SELECT 
            p.id AS id, 
            p.title AS title, 
            p.slug AS slug, 
            p.thumbnail AS thumbnail, 
            p.default_price AS price, 
            p.num_reviews AS num_reviews, 
            p.score_review AS score_review, 
            c.name AS city_name, 
            COUNT(r.id) AS count_room 
        FROM 
            products p 
        JOIN 
            hotel h ON h.id = p.id
        JOIN 
            cities c ON c.id = h.city_id
        LEFT JOIN 
            rooms r ON r.product_id = p.id
        WHERE 
            p.active = 1
        GROUP BY 
            p.id, p.title, p.slug, p.thumbnail, p.default_price, p.num_reviews, 
            p.score_review, c.name
        ORDER BY 
            p.id ASC 
        LIMIT 6;
        ";
        $hotel = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $hotel;
    }

    public function getCityActive()
    {
        $sql = "SELECT * FROM cities WHERE thumbnail IS NOT NULL";
        $city = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $city;
    }

    public function getHotelBySlug($slug)
    {
        $sql = "SELECT 
            p.id AS id, 
            p.title AS title, 
            p.address AS address, 
            p.map_link AS map_link, 
            p.map_iframe_link AS map_iframe_link, 
            p.num_reviews AS num_reviews, 
            p.score_review AS score_review, 
            p.slug AS slug, 
            p.thumbnail AS thumbnail, 
            p.images AS images, 
            p.default_price AS price, 
            h.admin AS admin, 
            c.name AS city_name, 
            COUNT(r.id) AS count_room 
            FROM 
                products p 
            JOIN 
                hotel h ON h.id = p.id 
            JOIN 
                cities c ON h.city_id = c.id 
            LEFT JOIN 
                rooms r ON r.product_id = p.id 
            WHERE 
                p.slug = '$slug' 
            GROUP BY 
                p.id, p.title, p.address, p.map_link, p.map_iframe_link, 
                p.num_reviews, p.score_review, p.slug, p.thumbnail, 
                p.images, p.default_price, h.admin, c.name;";
        $data = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getHotelLongDesc($id)
    {
        $sql = "SELECT * FROM long_desc WHERE product_id = $id";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getHotelShortDesc($id)
    {
        $sql = "SELECT description FROM short_desc WHERE product_id = $id";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getHotelRoom($id)
    {
        $sql = "SELECT * FROM rooms WHERE product_id = $id";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
