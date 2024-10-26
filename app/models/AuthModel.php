<?php
class AuthModel extends Model
{
    protected $_table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function checkLogin($username, $password)
    {
        if ($this->isPost()) {
            $fillterAll = $this->filter();

            $username = $fillterAll['username'];
            $password = $fillterAll['password'];

            $errors = [];
            $userQuery = $this->db->query('SELECT * FROM ' . $this->_table . ' WHERE name = "' . $username . '"')->fetch(PDO::FETCH_ASSOC);

            if (!$userQuery) {
                $this->setFlashData('error', value: 'username is invalid');
                $errors['username'] = $this->getFlashData('error');
                return $errors;
            } else {
                $passwordHash = $userQuery['password'];
                $checkPassword = password_verify($password, $passwordHash);

                if (!$checkPassword) {
                    $this->setFlashData('error', value: 'password is invalid');
                    $errors['password'] = $this->getFlashData('error');
                    return $errors;
                } else {
                    $tokenLogin = sha1(uniqid() . time());
                    try {
                        $insertToken = $this->db->insert('tokenlogin', [
                            'token' => $tokenLogin,
                            'user_id' => $userQuery['id'],
                            'created_at' => date('Y-m-d H:i:s'),
                        ]);

                        if ($insertToken) {
                            $this->setSession('loginToken', $tokenLogin, 60 * 60 * 24 * 7); // 7 ngày
                            setcookie('loginToken', $tokenLogin, time() + 60 * 60 * 24 * 7);
                            $this->setSession('login-success', 'Đăng nhập thành công!');
                            header('Location: ' . _WEB_ROOT . '/backend/dashboard');
                            return true;
                        }
                    } catch (Exception $e) {
                        $this->setFlashData('error-system', value: 'Lỗi hệ thống, vui lòng thử lại sau!');
                        $errors['login']['system'] = $this->getFlashData('error-system');
                        return $errors;
                    }
                }
            }
        }
        return false;
    }

    public function logout()
    {
        $token = $_SESSION['loginToken'] ?? $_COOKIE['loginToken'] ?? null;

        if ($token) {
            $this->db->query("DELETE FROM tokenlogin WHERE token = '$token'");
        }
        $this->removeSession('loginToken');
        $this->removeSession('time');
    }

}