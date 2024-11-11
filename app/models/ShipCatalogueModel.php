<?php

use GuzzleHttp\Client;
use GuzzleHttp\Promise;

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
            $urls = $this->uploadImageToCloudinary();
            $filterAll = $this->filter();
            $data = [
                'name' => $filterAll['name'],
                'image' => $urls,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            try {
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
            if (empty($_FILES['image']['name'][0])) {
                header('Location: ' . _WEB_ROOT . '/backend/ship/catalogue');
            } else {
                $urls = $this->uploadImageToCloudinary();

                $filterAll = $this->filter();
                $data = [
                    'name' => $filterAll['name'],
                    'image' => $urls,
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

    private function uploadImageToCloudinary()
    {
        $client = new Client();
        $promises = [];

        $makeFile = $this->handleUploadFile('public/img/ship-category/', 'image', false);

        foreach ($_FILES['image']['name'] as $key => $name) {
            $filepath = 'public/img/ship-category/' . $_FILES['image']['name'][$key];

            $promises[] = $client->postAsync('https://api.cloudinary.com/v1_1/' . _CLOUDINARY_CLOUD_NAME . '/upload', [
                'multipart' => [
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
                        'name' => 'folder',
                        'contents' => 'ship-category',
                    ],
                ],
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
}
