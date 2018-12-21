<?php
/**
 * Created by Luis Landero
 */
spl_autoload_register(function($className) {
    require_once 'vendor/autoload.php';

    if (file_exists('src/'.$className.'.php')) {
        require_once('src/'.$className . '.php');
        return;
    }
});