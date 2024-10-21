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
                    $this->setSession('user', $userQuery, 60);
                    header('Location: ' . _WEB_ROOT . '/backend/dashboard');
                    return true;
                }
            }
        }

        return false;
    }

}