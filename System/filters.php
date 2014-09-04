<?php namespace Fzaffa\System;

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