<?php namespace Fzaffa\System;

class Message {
    public static function send($title, $message)
    {
        $_SESSION['messages'][$title] = $message;
    }
    public static function recive($title)
    {
        if(isset($_SESSION['messages'][$title])) {
            $message = $_SESSION['messages'][$title];
            unset($_SESSION['messages'][$title]);
            return $message;
        }
    }
    public static function has($title)
    {
        if(isset($_SESSION['messages'][$title])) return true;
        return false;
    }
} 