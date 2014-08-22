<?php
session_start();
class Auth {
    public static function login($user, $password)
    {
        if($user == 'admin' && $password == 'password')
        {
            $_SESSION['logged'] = true;
            return true;
        }
        return false;
    }

    public static function logout()
    {
        session_destroy();
    }

    public static function check()
    {
        if(isset($_SESSION['logged']))
        {
            return true;
        }

        return false;
    }
}
/*auth::check deve controllare se sono loggato e ritornare true or false

auth::login('admina', 'pasword') deve tentare il login e ritornare true or false se il login avviene

auth::logout() deve distruggere la sessine

tutte le pagine dell'admina devono controllare la presenza di una sessione altrimenti reindrizzare alla pagina di login*/