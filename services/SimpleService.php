<?php
/**
 * Created by PhpStorm.
 * User: gbetlej
 * Date: 22.08.2017
 * Time: 11:45
 */

namespace services;

use phpager\Service;

class SimpleService extends Service
{

    function onCreate()
    {
        // TODO: Implement onCreate() method.
        echo "service onCreate()";
    }

    function onCommandSend(String $command, int $mode): int
    {
        // TODO: Implement onCommandSend() method.
    }
}