<?php
/**
 * Created by PhpStorm.
 * User: gbetlej
 * Date: 22.08.2017
 * Time: 10:29
 */

namespace phpager;


class Framework
{

    public static function init() {
        if (!session_id()) {
            session_start();
        }
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        set_include_path("libs/");
        spl_autoload_register(function ($class_name) {
            include $class_name . '.php';
        });
    }
}