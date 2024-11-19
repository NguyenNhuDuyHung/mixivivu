<?php
class AuthModel extends Model
{
    protected $_table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function checkLogin($email, $password)
    {
        if ($this->isPost()) {
            $fillterAll = $this->filter();

            $email = $fillterAll['email'];
            $password = $fillterAll['password'];

            $errors = [];
            $userQuery = $this->db->query('SELECT * FROM ' . $this->_table . ' WHERE email = "' . $email . '"')->fetch(PDO::FETCH_ASSOC);

            if (!$userQuery) {
                $this->setFlashData('error', value: 'email is invalid');
                $errors['email'] = $this->getFlashData('error');
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
                            $this->setSession('loginToken', $tokenLogin, 60 * 60 * 24); // 1 ngày
                            setcookie('loginToken', $tokenLogin, time() + 60 * 60 * 24);
                            $this->setSession('toast-success', 'Đăng nhập thành công!');
                            header('Location: ' . _WEB_ROOT . '/backend/dashboard');
                            return true;
                        }
                    } catch (Exception $e) {
                        $this->setFlashData('toast-error', value: 'Lỗi hệ thống, vui lòng thử lại sau!');
                        $errors['login']['system'] = $this->getFlashData('toast-error');
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