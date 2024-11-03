<?php
class UserCatalogueModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT 
            uc.id AS id, 
            uc.name AS name, 
            uc.description AS description, 
            COUNT(u.id) AS user_count 
        FROM 
            user_catalogues uc 
        LEFT JOIN 
            users u ON uc.id = u.user_catalogue_id AND u.deleted_at IS NULL 
        WHERE 
            uc.deleted_at IS NULL 
        GROUP BY 
            uc.id 
        ORDER BY 
            uc.id ASC 
        LIMIT " . $offset . ", " . $recordsPerPage . "";
        $user_catalogues = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $user_catalogues;
    }

    public function search($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT * FROM user_catalogues WHERE name LIKE '%" . $keyword . "%' OR description LIKE '%" . $keyword . "%' ORDER BY id ASC LIMIT " . $offset . ", " . $recordsPerPage . "";
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
                'name' => $filterAll['name'],
                'description' => $filterAll['description'],
                'created_at' => date('Y-m-d H:i:s'),
            ];
            try {
                $checkUserCatalogue = $this->checkRecord(
                    'user_catalogues',
                    ['name'],
                    [$data['name']],
                    null,
                    ['name' => 'Đã tồn tại nhóm người dùng!']
                );

                if ($checkUserCatalogue == false) {
                    return false;
                }

                $createUserCatalogue = $this->db->insert('user_catalogues', $data);
                if (!$createUserCatalogue) {
                    $this->setSession('toast-error', 'Thêm không thành công! Vui lòng thử lại sau!');
                    return false;
                }
                $this->setSession('toast-success', 'Thêm nhóm người dùng thành công!');
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function updateUserCatalogue($id)
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            $newData = [
                'name' => $filterAll['name'],
                'description' => $filterAll['description'],
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $checkUserCatalogue = $this->checkRecord(
                    'user_catalogues',
                    ['name'],
                    [$newData['name']],
                    $id,
                    ['name' => 'Đã tồn tại nhóm người dùng!']
                );

                if ($checkUserCatalogue == false) {
                    return false;
                } else {
                    $updateUserCatalogue = $this->db->update('user_catalogues', $newData, 'id = ' . $id);

                    if (!$updateUserCatalogue) {
                        $this->setSession('toast-error', 'Cập nhật không thành công! Vui lòng thử lại sau!');
                        return false;
                    }
                    $this->setSession('toast-success', 'Cập nhật nhóm người dùng thành công!');
                    return true;
                }
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }

    public function softDeleteUserCatalogue($id)
    {
        try {
            $checkUserInUserCatalogue = $this->checkRecordExist('users', 'user_catalogue_id', $id);
            if ($checkUserInUserCatalogue) {
                $this->setSession('toast-error', 'Không thể xóa nhóm người dùng!');
                return false;
            }
            $this->db->update('user_catalogues', ['deleted_at' => date('Y-m-d H:i:s')], 'id = ' . $id);
            $this->setSession('toast-success', 'Xóa nhóm người dùng thành công!');
            return true;
        } catch (Exception $e) {
            $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return false;
        }
    }

    public function hardDeleteUserCatalogue($id)
    {
        try {
            $checkUserInUserCatalogue = $this->checkRecordExist('users', 'user_catalogue_id', $id);
            if ($checkUserInUserCatalogue) {
                $this->setSession('toast-error', 'Không thể xóa nhóm người dùng!');
                return false;
            }
            $this->db->delete('user_catalogues', 'id = ' . $id);
            $this->setSession('toast-success', 'Xóa nhóm người dùng thành công!');
            return true;
        } catch (Exception $e) {
            $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return false;
        }
    }
}
