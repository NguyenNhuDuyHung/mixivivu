<?php
class LongDescCatalogueModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT 
            ldt.id AS id, 
            ldt.type AS type, 
            COUNT(ld.id) AS ld_count 
        FROM 
            long_desc_type ldt
        LEFT JOIN 
            long_desc ld ON ldt.id = ld.type
        GROUP BY 
            ldt.id 
        ORDER BY 
            ldt.id ASC 
        LIMIT " . $offset . ", " . $recordsPerPage . "";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return $data;
    }

    public function search($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT 
            ldt.id AS id, 
            ldt.type AS type, 
            COUNT(ld.id) AS ld_count 
        FROM 
            long_desc_type ldt
        LEFT JOIN 
            long_desc ld ON ldt.id = ld.type
        WHERE 
            ldt.type LIKE '%" . $keyword . "%'
        GROUP BY 
            ldt.id 
        ORDER BY 
            ldt.id ASC 
        LIMIT " . $offset . ", " . $recordsPerPage . "";

        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return $data;
    }

    public function create()
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();
            $data = [
                'type' => $filterAll['type'],
                'created_at' => date('Y-m-d H:i:s'),
            ];
            try {
                $check = $this->checkRecord(
                    'long_desc_type',
                    ['type'],
                    [$data['type']],
                    null,
                    ['type' => 'Đã tồn tại nhóm long-desc!']
                );

                if ($check == false) {
                    return false;
                }

                $create = $this->db->insert('long_desc_type', $data);
                if (!$create) {
                    $this->setSession('toast-error', 'Thêm không thành công! Vui lòng thử lại sau!');
                    return false;
                }
                $this->setSession('toast-success', 'Thêm thành công!');
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function updateDescCatalogue($id)
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            $newData = [
                'type' => $filterAll['type'],
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $check = $this->checkRecord(
                    'long_desc_type',
                    ['type'],
                    [$newData['type']],
                    $id,
                    ['name' => 'Đã tồn tại nhóm long-desc!']
                );

                if ($check == false) {
                    return false;
                } else {
                    $update = $this->db->update('long_desc_type', $newData, 'id = ' . $id);

                    if (!$update) {
                        $this->setSession('toast-error', 'Cập nhật không thành công! Vui lòng thử lại sau!');
                        return false;
                    }
                    $this->setSession('toast-success', 'Cập nhật thành công!');
                    return true;
                }
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }

    public function deleteDescCatalogue($id)
    {
        try {
            $check = $this->checkRecordExist('long_desc', 'type', $id);
            if ($check) {
                $this->setSession('toast-error', 'Không thể xóa!');
                return false;
            }
            $this->db->delete('long_desc_type', 'id = ' . $id);
            $this->setSession('toast-success', 'Xóa thành công!');
            return true;
        } catch (Exception $e) {
            $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return false;
        }
    }
}
