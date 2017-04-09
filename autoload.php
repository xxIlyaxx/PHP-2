<?php

function __autoload($className)
{
    $fileName =  __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
    if (file_exists($fileName)) {
        require $fileName;
    }
}