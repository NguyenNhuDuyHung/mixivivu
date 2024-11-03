<?php
class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function pagination($offset, $recordsPerPage)
    {
        $sql = "SELECT u.id AS id, u.name AS name, u.email AS email, u.publish AS publish, 
            uc.name AS role
        FROM users u
        JOIN user_catalogues uc     
        ON u.user_catalogue_id = uc.id
        WHERE u.deleted_at IS NULL
        ORDER BY u.id ASC
        LIMIT " . $offset . ", " . $recordsPerPage . "
        ";

        $users = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function create()
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            $role = $filterAll['role'] == 'Quản trị viên' ? 1 : 2;
            $data = [
                'name' => $filterAll['name'],
                'email' => $filterAll['email'],
                'password' => $filterAll['password'],
                'user_catalogue_id' => $role,
                'phone' => $filterAll['phone'],
                'created_at' => date('Y-m-d H:i:s'),
            ];

            try {
                $checkUser = $this->checkRecord(
                    'users',
                    ['email', 'phone'],
                    [$data['email'], $data['phone']],
                    null,
                    [
                        'email' => 'Email đã tồn tại!',
                        'phone' => 'Số điện thoại đã tồn tại!'
                    ]
                );

                if ($checkUser == false) {
                    return false;
                }

                $createUser = $this->db->insert('users', $data);
                if (!$createUser) {
                    $this->setSession('toast-error', 'Thêm không thành công! Vui lòng thử lại sau!');
                    return false;
                }
                $this->setSession('toast-success', 'Thêm người dùng thành công!');
                return true;
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function updateUser($id)
    {
        if ($this->isPost()) {
            $filterAll = $this->filter();

            $newData = [
                'name' => $filterAll['name'],
                'email' => $filterAll['email'],
                'phone' => $filterAll['phone'],
                'password' => $filterAll['password'],
                'user_catalogue_id' => $filterAll['role'] == 'Quản trị viên' ? 1 : 2,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $newData['password'] = password_hash($newData['password'], PASSWORD_BCRYPT);

            try {
                $checkUser = $this->checkRecord(
                    'users',
                    ['email', 'phone'],
                    [$newData['email'], $newData['phone']],
                    $id,
                    [
                        'email' => 'Email đã tồn tại!',
                        'phone' => 'Số điện thoại đã tồn tại!'
                    ]
                );

                if ($checkUser == false) {
                    return false;
                } else {
                    $this->db->update('users', $newData, 'id = ' . $id);
                    $this->setSession('toast-success', 'Cập nhật người dùng thành công!');
                    return true;
                }
            } catch (Exception $e) {
                $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
                return false;
            }
        }
    }

    public function softDeleteUser($id)
    {
        try {
            $this->db->update('users', ['deleted_at' => date('Y-m-d H:i:s')], 'id = ' . $id);
            $this->setSession('toast-success', 'Xóa người dùng thành công!');
            return true;
        } catch (Exception $e) {
            $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return false;
        }
    }

    public function hardDeleteUser($id)
    {
        try {
            $this->db->delete('users', 'id = ' . $id);
            $this->setSession('toast-success', 'Xóa người dùng thành công!');
            return true;
        } catch (Exception $e) {
            $this->setSession('toast-error', 'Có lỗi xảy ra: ' . $e->getMessage());
            return false;
        }
    }

    public function search($keyword, $offset, $recordsPerPage)
    {
        $sql = "SELECT u.id AS id, u.name AS name, u.email AS email, u.publish AS publish, 
            uc.name AS role
        FROM users u
        JOIN user_catalogues uc     
        ON u.user_catalogue_id = uc.id
        WHERE u.name LIKE '%" . $keyword . "%'
        OR u.email LIKE '%" . $keyword . "%'
        ORDER BY u.id ASC
        LIMIT " . $offset . ", " . $recordsPerPage . "
        ";
        $data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }
        return $data;
    }
}
