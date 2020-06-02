<?php

namespace Models;

use App;

class User
{

    public static function login($login, $password)
    {

        $query = 'SELECT * FROM users';
        $users = App::$db->execute($query);

        foreach ($users as $user) {
            if ($user['login'] === $login && $user['password'] === md5($password)) {
                $_SESSION['login'] = $login;
                $_SESSION['password'] = $password;

                return true;
            }
        }

        return false;

    }

    public static function is_login()
    {
        
        if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
            return true;
        }
        else {
            return false;
        }

    }
}