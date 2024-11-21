<?php
class LongDescModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function search($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT p.id, p.title, COUNT(ld.id) AS countDesc
        FROM products p
        JOIN long_desc ld ON p.id = ld.product_id
        WHERE p.title LIKE '%" . $keyword . "%'
        GROUP BY p.id   
        ORDER BY p.id DESC
        LIMIT " . $offset . ", " . $recordsPerPage . " ";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return $data;
    }

    public function countPageLongDescSearch($keyword, $recordsPerPage)
    {
        $sql = "SELECT COUNT(*) AS total
            FROM (
                SELECT p.id
                FROM products p
                JOIN long_desc sd ON p.id = sd.product_id
                WHERE p.title LIKE '%" . $keyword . "%'
                GROUP BY p.id
            ) AS subquery";

        $total = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return ceil($total['total'] / $recordsPerPage);
    }

    public function countAllLongDescSearch($keyword)
    {
        $sql = "SELECT COUNT(*) AS total
            FROM (
                SELECT p.id
                FROM products p
                JOIN long_desc sd ON p.id = sd.product_id
                WHERE p.title LIKE '%" . $keyword . "%'
                GROUP BY p.id
            ) AS subquery";

        $total = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }

    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT p.id, p.title, COUNT(ld.id) AS countDesc
        FROM products p
        JOIN long_desc ld ON p.id = ld.product_id
        GROUP BY p.id   
        ORDER BY p.id DESC
        LIMIT " . $offset . ", " . $recordsPerPage . " ";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function createLongDesc()
    {
        if ($this->isPost()) {
            if (empty($_FILES['image']['name'][0])) {
                return false;
            }

            $filterAll = $this->filter();

            $imageTargetDir = 'public/img/long-desc/';
            $imageUrls = $this->uploadImageToCloudinary($imageTargetDir, 'image',  'long-desc');

            $data = [
                'product_id' => $filterAll['product_id'],
                'text' => $filterAll['text'],
                'type' => $filterAll['type'],
                'caption' => $filterAll['caption'],
                'image_url' => $imageUrls
            ];

            $insertData = [];

            // Vị trí của các phần tử trong mảng image_url và text
            $imageIndex = 0;
            $textIndex = 0;

            foreach ($data['type'] as $typeValue) {
                $record = [
                    'product_id' => $data['product_id'],
                    'type' => $typeValue,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                // Kiểm tra type để xác định thêm text hoặc image_url
                if ($typeValue == 1 || $typeValue == 2) {
                    // Với type = 1 hoặc 2, chỉ thêm text
                    $record['text'] = isset($data['text'][$textIndex]) ? $data['text'][$textIndex] : null;
                    $record['image_url'] = null;
                    $textIndex++; // Tăng textIndex để lấy text tiếp theo
                } elseif ($typeValue == 3) {
                    // Với type = 3, chỉ thêm image_url nếu còn trong mảng image_url
                    $record['image_url'] = isset($data['image_url'][$imageIndex]) ? $data['image_url'][$imageIndex] : null;
                    $record['caption'] = isset($data['caption'][$imageIndex]) ? $data['caption'][$imageIndex] : null;
                    $record['text'] = null;
                    $imageIndex++; // Tăng imageIndex để lấy ảnh tiếp theo cho lần duyệt sau
                }

                // Thêm bản ghi đã hoàn thiện vào mảng insertData
                $insertData[] = $record;
            }

            try {
                foreach ($insertData as $key => $value) {
                    $create = $this->db->insert('long_desc', $value);
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

    public function updateLongDesc($id)
    {
        if ($this->isPost()) {
            $getImages = array_values(array_filter(array_column($this->findById('long_desc', $id, ['image_url'], [], 'product_id', true), 'image_url')));
            $filterAll = $this->filter();

            $imageTargetDir = 'public/img/long-desc/';
            $imageUrls = $this->uploadImageToCloudinary($imageTargetDir, 'image',  'long-desc');

            $data = [
                'product_id' => $filterAll['product_id'],
                'text' => $filterAll['text'],
                'type' => $filterAll['type'],
                'caption' => $filterAll['caption'],
                'image_url' => array_merge($getImages, $imageUrls),
            ];

            $insertData = [];

            // Vị trí của các phần tử trong mảng image_url và text
            $imageIndex = 0;
            $textIndex = 0;

            foreach ($data['type'] as $typeValue) {
                $record = [
                    'product_id' => $data['product_id'],
                    'type' => $typeValue,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                // Kiểm tra type để xác định thêm text hoặc image_url
                if ($typeValue == 1 || $typeValue == 2) {
                    // Với type = 1 hoặc 2, chỉ thêm text
                    $record['text'] = isset($data['text'][$textIndex]) ? $data['text'][$textIndex] : null;
                    $record['image_url'] = null;
                    $textIndex++; // Tăng textIndex để lấy text tiếp theo
                } elseif ($typeValue == 3) {
                    // Với type = 3, chỉ thêm image_url nếu còn trong mảng image_url
                    $record['image_url'] = isset($data['image_url'][$imageIndex]) ? $data['image_url'][$imageIndex] : null;
                    $record['caption'] = isset($data['caption'][$imageIndex]) ? $data['caption'][$imageIndex] : null;
                    $record['text'] = null;
                    $imageIndex++; // Tăng imageIndex để lấy ảnh tiếp theo cho lần duyệt sau
                }

                // Thêm bản ghi đã hoàn thiện vào mảng insertData
                $insertData[] = $record;
            }

            try {
                $clear = $this->db->delete('long_desc', 'product_id = ' . $id);
                if (!$clear) {
                    $this->setSession('toast-error', 'Có lỗi! Vui lòng thử lại sau!');
                    return false;
                }
                foreach ($insertData as $key => $value) {
                    $create = $this->db->insert('long_desc', $value);
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

    public function deleteLongDesc($id)
    {
        try {
            $delete = $this->db->delete('long_desc', 'product_id = ' . $id);
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
