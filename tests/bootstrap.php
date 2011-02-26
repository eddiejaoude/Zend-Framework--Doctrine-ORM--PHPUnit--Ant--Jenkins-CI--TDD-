<?php
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(dirname(__FILE__) . '/../library'),
    get_include_path(),
)));

defined('APP_ENVIRONMENT') || define('APP_ENVIRONMENT', 'testing');
defined('APP_PATH') || define('APP_PATH', realpath(dirname(__FILE__) . '/../application'));

require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();

/**
 * Base Controller Test Class
 *
 * All controller tests should extend this
 */
abstract class BaseTestCase extends Zend_Test_PHPUnit_ControllerTestCase {

    public function setUp() {
        return parent::setUp();
    }

    public function tearDown() {
        
    }
}