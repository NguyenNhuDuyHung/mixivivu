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
        ORDER BY u.id ASC
        LIMIT " . $offset . ", " . $recordsPerPage . "
        ";

        $users = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function countPage($recordsPerPage)
    {
        $sql = "SELECT COUNT(*) AS total FROM users";
        $total = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return ceil($total['total'] / $recordsPerPage);
    }

    public function countAllUser()
    {
        $sql = "SELECT COUNT(*) AS total FROM users";
        $total = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $total['total'];
    }

    private function checkUser($email, $phone, $id = null)
    {
        if (!empty($id)) {
            $checkEmail = $this->db->query('SELECT email FROM users WHERE email = "' . $email . '" AND id != ' . $id)->fetch(PDO::FETCH_ASSOC);
            $checkPhone = $this->db->query('SELECT phone FROM users WHERE phone = "' . $phone . '" AND id != ' . $id)->fetch(PDO::FETCH_ASSOC);
        } else {
            $checkEmail = $this->db->query('SELECT email FROM users WHERE email = "' . $email . '"')->fetch(PDO::FETCH_ASSOC);
            $checkPhone = $this->db->query('SELECT phone FROM users WHERE phone = "' . $phone . '"')->fetch(PDO::FETCH_ASSOC);
        }


        if (!empty($checkEmail)) {
            $this->setSession('toast-error', 'Email đã tồn tại');
            return false;
        }

        if (!empty($checkPhone)) {
            $this->setSession('toast-error', 'Số điện thoại đã tồn tại');
            return false;
        }

        return true;
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
                $checkUser = $this->checkUser($data['email'], $data['phone']);
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

    public function getUserById($id)
    {
        $data = $this->db->query('SELECT * FROM users WHERE id = ' . $id)->fetch(PDO::FETCH_ASSOC);
        return $data;
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

                $checkUser = $this->checkUser($newData['email'], $newData['phone'], $id);

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

    public function deleteUser($id)
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
}