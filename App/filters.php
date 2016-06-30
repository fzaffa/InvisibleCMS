<?php namespace Invisible;

use Fzaffa\System\Auth;

trait Filters {
    public function filterAuth()
    {
        if( ! Auth::check())
        {
            include 'App/Views/admin/login.php';
            exit(0);
        }
    }
}