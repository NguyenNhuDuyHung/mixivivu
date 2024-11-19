<?php
class FeatureModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT f.id AS id, f.text AS text, f.icon AS icon, ft.name AS type FROM features f JOIN feature_types ft ON f.type = ft.id ORDER BY id ASC LIMIT " . $offset . ", " . $recordsPerPage;
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getAllFeatures()
    {
        $sql = "SELECT * FROM features";
        $features = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $features;
    }
    public function getFeatureType()
    {
        $sql = "SELECT * FROM feature_types";
        $feature_types = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $feature_types;
    }

    public function create()
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();
            $iconTargerDir = 'public/img/feature/';
            $iconUrl = $this->uploadImageToCloudinary($iconTargerDir, 'icon', 'icon', true);

            $featureType = $filterAll['type'];
            switch ($featureType) {
                case 'room':
                    $featureType = 1;
                    break;
                case 'ship':
                    $featureType = 2;
                    break;
                case 'hotel':
                    $featureType = 3;
                    break;
                default:
                    $featureType = 1;
                    break;
            }

            $data = [
                'text' => $filterAll['text'],
                'icon' => $iconUrl,
                'type' => $featureType,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $checkFeature = $this->checkRecord(
                    'features',
                    ['text'],
                    [$data['text']],
                    null,
                    [
                        'text' => 'Đặc trưng đã tồn tại!'
                    ]
                );

                if ($checkFeature == false) {
                    return false;
                }

                $create = $this->db->insert('features', $data);
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

    public function updateFeature($id)
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            $featureType = $filterAll['type'];
            switch ($featureType) {
                case 'room':
                    $featureType = 1;
                    break;
                case 'ship':
                    $featureType = 2;
                    break;
                case 'hotel':
                    $featureType = 3;
                    break;
                default:
                    $featureType = 1;
                    break;
            }

            $iconTargerDir = 'public/img/feature/';
            if (empty($_FILES['icon']['name'][0])) {
                $iconUrl = $this->findById('features', $id, ['icon']);
            } else {
                $iconUrl = $this->uploadImageToCloudinary($iconTargerDir, 'icon', 'icon', true);
            }

            $newData = [
                'text' => $filterAll['text'],
                'type' => $featureType,
                'icon' => $iconUrl,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $checkFeature = $this->checkRecord(
                    'features',
                    ['text'],
                    [$newData['text']],
                    $id,
                    [
                        'text' => 'Đặc trưng đã tồn tại!'
                    ]
                );

                if ($checkFeature == false) {
                    return false;
                } else {
                    $this->db->update('features', $newData, 'id = ' . $id);
                    $this->setSession('toast-success', 'Cập nhật thành công!');
                    return true;
                }
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }

    public function deleteFeature($id)
    {
        try {
            $this->db->delete('product_feature', 'feature_id = ' . $id);
            $this->db->delete('features', 'id = ' . $id);
            $this->setSession('toast-success', 'Xóa thành công!');
            return true;
        } catch (Exception $e) {
            $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return false;
        }
    }

    public function search($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT f.id AS id, f.text AS text, f.icon AS icon, ft.name AS type FROM features f JOIN feature_types ft ON f.type = ft.id WHERE f.text LIKE '%" . $keyword . "%' ORDER BY id ASC LIMIT " . $offset . ", " . $recordsPerPage;

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return $data;
    }
}
