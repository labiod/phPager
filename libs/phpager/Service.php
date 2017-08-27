<?php
/**
 * Created by PhpStorm.
 * User: gbetlej
 * Date: 21.08.2017
 * Time: 14:20
 */
namespace phpager;

abstract class Service
{
    abstract function onCreate();

    abstract function onCommandSend(String $command, int $mode): int;
}