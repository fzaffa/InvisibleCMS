<?php
function __autoload($className)
{
    require_once $_SERVER['DOCUMENT_ROOT'].'/'.$className.'.php';
}

