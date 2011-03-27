<?php
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(dirname(__FILE__) . '/../library'),
    get_include_path(),
)));

defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'testing');
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();

/**
 * Base Controller Test Class
 *
 * All controller tests should extend this
 */
use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration;
abstract class BaseTestCase extends Zend_Test_PHPUnit_ControllerTestCase {

    protected $_em;
    
    public function setUp() {
        $this->appConfig = new Zend_Config_Ini( APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);

        $this->doctrine();
        
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
        return;
    }

    public function tearDown() {
        
    }
    
    private function doctrine() {
        # doctrine loader
        require_once './../library/Doctrine/Common/ClassLoader.php';
        $doctrineAutoloader = new \Doctrine\Common\ClassLoader('Doctrine', './../library');
        $doctrineAutoloader->register();
        
        # configure doctrine
        $cache = new Doctrine\Common\Cache\ArrayCache;
        $config = new Configuration;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver( '/entities' );
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir( '/proxies' );
        $config->setProxyNamespace('Proxies');
        $config->setAutoGenerateProxyClasses(true);

        # database connection
        $this->_em = EntityManager::create($this->appConfig->doctrine->connection->toArray(), $config);
    }
}