<?php
/**
 * Created by PhpStorm.
 * User: gbetlej
 * Date: 21.08.2017
 * Time: 14:14
 */

include "libs/phpager/Framework.php";

\phpager\Framework::init();
//session_destroy();die();
use phpager\Application;

$app = Application::getInstance();
$app->startAction();


