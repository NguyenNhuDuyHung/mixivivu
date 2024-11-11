<?php

use GuzzleHttp\Client;
use GuzzleHttp\Promise;

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

    private function uploadImageToCloudinary($targetDir, $file, $folder)
    {
        $client = new Client();
        $promises = [];

        $makeFile = $this->handleUploadFile($targetDir, $file, false);

        foreach ($_FILES[$file]['name'] as $key => $name) {
            $filepath = $targetDir . $_FILES[$file]['name'][$key];

            $promises[] = $client->postAsync('https://api.cloudinary.com/v1_1/' . _CLOUDINARY_CLOUD_NAME . '/upload', [
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
                        ],
                    ],
                )
            ]);
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

    public function createInfoShip()
    {

        if ($this->isPost()) {
            $filterAll = $this->filter();
            $thumbTargetDir = 'public/img/thumbnail/' . $filterAll['slug'] . '/';
            $imageTargetDir = 'public/img/tour/' . $filterAll['slug'] . '/';
            $makeThumbFile = $this->handleUploadFile($thumbTargetDir, 'thumbnail', false);
            $makeTourFile = $this->handleUploadFile($imageTargetDir, 'images', false);

            $thumbUrl = $this->uploadImageToCloudinary($thumbTargetDir, 'thumbnail', 'thumbnail');
            $imageUrls = $this->uploadImageToCloudinary($imageTargetDir, 'images',  'tour');

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
                $makeThumbFile = null;
                $thumbUrl = $imagesCruise['thumbnail'];
            } else {
                $makeThumbFile = $this->handleUploadFile($thumbTargetDir, 'thumbnail', false);
                $thumbUrl = $this->uploadImageToCloudinary($thumbTargetDir, 'thumbnail', 'thumbnail');
            }

            if (empty($_FILES['images']['name'][0])) {
                $makeTourFile = null;
                $imageUrls = $imagesCruise['images'];
            } else {
                $makeTourFile = $this->handleUploadFile($imageTargetDir, 'images', false);
                $imageUrls = $this->uploadImageToCloudinary($imageTargetDir, 'images', 'tour');
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

                $this->db->query("UPDATE products SET thumbnail = NULL, images = NULL WHERE id = $id");
                $this->db->update('cruise', $cruiseData, 'id = ' . $id);
                $this->db->update('products', $productData, 'id = ' . $id);
                $this->setSession('toast-success', 'Cập nhật thành công!');
                return true;
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
