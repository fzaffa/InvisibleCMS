<?php

trait Filters {
    public function filterAuth()
    {
        if( ! Auth::check())
        {
            include 'views/admin/login.php';
            exit(0);
        }
    }
}