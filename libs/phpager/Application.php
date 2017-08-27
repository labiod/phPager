<?php
/**
 * Created by PhpStorm.
 * User: gbetlej
 * Date: 21.08.2017
 * Time: 14:27
 */
namespace phpager;

class Application
{
    /**
     * @var Application
     */
    private static $INSTANCE = null;
    public static function getInstance(): Application
    {
        if (self::$INSTANCE != null) {
            return self::$INSTANCE;
        }
        if (isset($_SESSION["application_obj"])) {
            self::$INSTANCE = unserialize($_SESSION["application_obj"]);
        } else {
            echo "New object";
            $configFile = "config.ini";
            self::$INSTANCE = self::createApplicationFromConfig($configFile);

            register_shutdown_function(function () {
                self::$INSTANCE->finish();
            });
        }
        return self::$INSTANCE;
    }

    private static function createApplicationFromConfig($configFile) : Application
    {
        $configTable = array();
        $handle = fopen($configFile, "r");
        if ($handle===false) {
           error_log("Config file not found");
        } else {
            $line = null;
             while (($line = fgets($handle)) != null) {
                 echo $line."<br/>";
                 $part = explode("=", $line);
                 $varName = array_shift($part);
                 $value = "";
                 if (sizeof($part) > 1) {
                    $value = implode("=", $part);
                 } else {
                     $value = array_shift($part);
                 }
                 $configTable[$varName] = $value;
             }
        }
        fclose($handle);
        $application = new Application($configTable);
        return $application;
    }

    private $_config;
    private $_applicationServices = array();

    private function __construct(array $config)
    {
        $this->_config = $config;
    }

//    public function __sleep()
//    {
//        // TODO: Implement __sleep() method.
//    }
//
//    public function __wakeup()
//    {
//        // TODO: Implement __wakeup() method.
//    }


    public function addService(string $className) {
        if (array_key_exists($className, $this->_applicationServices)) {
            array_push($this->_applicationServices, $className, new $className());
        }
    }

    public function loadContent($string)
    {
    }

    public function finish()
    {
        echo "Application onDestroy";
        $_SESSION["application_obj"] = serialize($this);
    }

    public function startAction()
    {
        if (isset($_GET["action_name"])) {
            echo "serviced started";
            $this->startService($_GET["service_name"]);
        } else {
            require_once "views/index.html";
        }
    }

    private function startService(string $serviceName) {
        /**
         * @var $service Service
         */
        require_once $serviceName.".php";
        $service = new $serviceName();
        $service->onCreate();
    }
}