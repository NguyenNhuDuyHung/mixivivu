<?php
class RoomModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function search($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT p.id AS product_id, p.title AS title, COUNT(r.id) AS countRoom 
        FROM products p JOIN rooms r ON p.id = r.product_id 
        WHERE p.title LIKE '%" . $keyword . "%' 
        GROUP BY p.id ORDER BY p.id ASC LIMIT " . $offset . ", " . $recordsPerPage;

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return $data;
    }

    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT p.id AS product_id, p.title AS title, COUNT(r.id) AS countRoom
        FROM products p
        JOIN rooms r ON p.id = r.product_id
        GROUP BY p.id   
        LIMIT " . $offset . ", " . $recordsPerPage . " ";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function create()
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();
            $productSlug = $this->findById('products', $filterAll['product_id'], ['slug'], [], 'id');
            $imageTargetDir = 'public/img/tour/' . $productSlug['slug'] . '/' . $filterAll['title'] . '/';
            $imageUrls = $this->uploadImageToCloudinary($imageTargetDir, 'images',  $filterAll['title'], true);

            $data = [
                'product_id' => $filterAll['product_id'],
                'title' => $filterAll['title'],
                'size' => $filterAll['size'],
                'max_persons' => $filterAll['max_persons'],
                'price' => $filterAll['price'],
                'sale_prices' => $filterAll['sale_prices'],
                'images' => $imageUrls,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $dataRoomFeatures = [
                'roomFeatures' => $filterAll['roomFeatures'],
                'room_id' => '',
            ];
            try {
                $createRoom = $this->db->insert('rooms', $data);
                if (!$createRoom) {
                    $this->setSession('toast-error', 'Thêm không thành công! Vui lòng thử lại sau!');
                    return false;
                }

                $room_id = $this->db->lastInsertId();
                $dataRoomFeatures['room_id'] = $room_id;

                foreach ($dataRoomFeatures['roomFeatures'] as $index => $roomFeature) {
                    $insertFeatureData = [
                        'room_id' => $room_id,
                        'feature_id' => $roomFeature
                    ];
                    $insertRoomFeature = $this->db->insert('rooms_feature', $insertFeatureData);
                }

                if ($insertRoomFeature) {
                    $this->setSession('toast-success', 'Cập nhật thành công!');
                    return true;
                } else {
                    $this->setSession('toast-error', 'Có lỗi xảy ra! Vui lòng thử lại sau!');
                    return false;
                }
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }

    public function updateRoom($id)
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();
            $productSlug = $this->findById('products', $filterAll['product_id'], ['slug'], [], 'id');
            $imageTargetDir = 'public/img/tour/' . $productSlug['slug'] . '/' . $filterAll['title'] . '/';

            $images = $this->findById('rooms', $id, ['images']);

            if (empty($_FILES['images']['name'][0])) {
                $imageUrls = $images['images'];
            } else {
                $imageUrls = $this->uploadImageToCloudinary($imageTargetDir, 'images', $filterAll['slug'], true);
                if (!empty($images['images'])) {
                    $imageUrls = $imageUrls . ',' . $images['images'];
                }
            }

            $data = [
                'product_id' => $filterAll['product_id'],
                'title' => $filterAll['title'],
                'size' => $filterAll['size'],
                'max_persons' => $filterAll['max_persons'],
                'price' => $filterAll['price'],
                'sale_prices' => $filterAll['sale_prices'],
                'images' => $imageUrls,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $dataRoomFeatures = [
                'roomFeatures' => $filterAll['roomFeatures'],
                'room_id' => '',
            ];
            try {
                $update = $this->db->update('rooms', $data, "id = " . $id);
                if (!$update) {
                    $this->setSession('toast-error', 'Thêm không thành công! Vui lòng thử lại sau!');
                    return false;
                }

                $dataRoomFeatures['room_id'] = $id;

                $clear = $this->db->delete('rooms_feature', 'room_id = ' . $id);
                if (!$clear) {
                    $this->setSession('toast-error', 'Thêm không thành công! Vui lòng thử lại sau!');
                    return false;
                }

                foreach ($dataRoomFeatures['roomFeatures'] as $index => $roomFeature) {
                    $insertFeatureData = [
                        'room_id' => $id,
                        'feature_id' => $roomFeature
                    ];
                    $insertRoomFeature = $this->db->insert('rooms_feature', $insertFeatureData);
                }

                if ($insertRoomFeature) {
                    $this->setSession('toast-success', 'Cập nhật thành công!');
                    return true;
                } else {
                    $this->setSession('toast-error', 'Có lỗi xảy ra! Vui lòng thử lại sau!');
                    return false;
                }
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }

    public function deleteOneRoom($id)
    {
        try {
            $clearFeature = $this->db->delete('rooms_feature', 'room_id = ' . $id);
            if (!$clearFeature) {
                $this->setSession('toast-error', 'Xóa không thành công! Vui lòng thử lại sau!');
                return false;
            }

            $delete = $this->db->delete('rooms', 'id = ' . $id);
            if (!$delete) {
                $this->setSession('toast-error', 'Xóa không thành công! Vui lòng thử lại sau!');
                return false;
            }

            $this->setSession('toast-success', 'Xóa thành công!');
            return true;
        } catch (Exception $e) {
            $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteAllRoom($id)
    {
        try {
            $roomId = array_column($this->findById('rooms', $id, ['id'], [], 'product_id', true), 'id');
            foreach ($roomId as $value) {
                $clearFeature = $this->db->delete('rooms_feature', 'room_id = ' . $value);
            }
            if (!$clearFeature) {
                $this->setSession('toast-error', 'Xóa không thành công! Vui lòng thử lại sau!');
                return false;
            }

            $delete = $this->db->delete('rooms', 'product_id = ' . $id);
            if (!$delete) {
                $this->setSession('toast-error', 'Xóa không thành công! Vui lòng thử lại sau!');
                return false;
            }

            $this->setSession('toast-success', 'Xóa thành công!');
            return true;
        } catch (Exception $e) {
            $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return false;
        }
    }
}
