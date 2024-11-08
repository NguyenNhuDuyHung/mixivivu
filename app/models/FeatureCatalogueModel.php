<?php
class FeatureCatalogueModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT * FROM feature_types LIMIT " . $offset . ", " . $recordsPerPage . " ";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function create()
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            $data = [
                'name' => $filterAll['name'],
                'created_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $checkFeatureType = $this->checkRecord(
                    'feature_types',
                    ['name'],
                    [$data['name']],
                    null,
                    [
                        'name' => 'Loại đặc trưng đã tồn tại!'
                    ]
                );

                if ($checkFeatureType == false) {
                    return false;
                }
                $create = $this->db->insert('feature_types', $data);
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

    public function updateFeatureType($id)
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            $newData = [
                'name' => $filterAll['name'],
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $checkFeature = $this->checkRecord(
                    'feature_types',
                    ['name'],
                    [$newData['name']],
                    $id,
                    [
                        'name' => 'Loại đặc trưng đã tồn tại!'
                    ]
                );

                if ($checkFeature == false) {
                    return false;
                } else {
                    $this->db->update('feature_types', $newData, 'id = ' . $id);
                    $this->setSession('toast-success', 'Cập nhật thành công!');
                    return true;
                }
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }

    public function deleteFeatureType($id)
    {
        try {
            $delete = $this->db->delete('feature_types', 'id = ' . $id);

            if (!$delete) {
                $this->setSession('toast-error', 'Xảy ra lỗi, vui lòng thử lại sau!');
                return false;
            }
            $this->setSession('toast-success', 'Xóa thành công!');
            return true;
        } catch (Exception $e) {
            $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return false;
        }
    }

    public function search($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT * FROM feature_types WHERE name LIKE '%" . $keyword . "%' ORDER BY id ASC LIMIT " . $offset . ", " . $recordsPerPage . " ";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return $data;
    }
}
