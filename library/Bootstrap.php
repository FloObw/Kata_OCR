<?php
/**
 * @codeCoverageIgnore
 */
class Bootstrap
{
    private static $_instance;
    private $_autoloader;
    
    private function __construct()
    {
        if (defined('DS')) {
            if (DS !== DIRECTORY_SEPARATOR) {
                throw new Exception();
            }
        } else {
            define('DS', DIRECTORY_SEPARATOR);
        }
        if (defined('PS')) {
            if (PS !== PATH_SEPARATOR) {
                throw new Exception();
            }
        } else {
            define('PS', PATH_SEPARATOR);
        }

        set_include_path(
            dirname(dirname(__FILE__)) 
            . DS 
            . 'library' 
            . PS 
            . get_include_path()
        );

        require_once 'Zend/Loader/Autoloader.php';
        $this->_autoloader = Zend_Loader_Autoloader::getInstance();
    }

    public function registerNamespace($namespace)
    {
        $this->_autoloader->registerNamespace($namespace);
    }

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new Bootstrap();
        }
        return self::$_instance;
    }
}
