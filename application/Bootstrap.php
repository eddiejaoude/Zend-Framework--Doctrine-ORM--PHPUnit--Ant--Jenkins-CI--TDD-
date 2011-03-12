<?php
/**
 * Application Bootstrap
 *
 * @author          Eddie Jaoude
 * @package       Default Module
 *
 */
use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration;
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    /**
     * Doctype
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return          void
     *
     */
    protected function _initDoctype() {
        $doctypeHelper = new Zend_View_Helper_Doctype();
        $doctypeHelper->doctype('XHTML1_STRICT');
    }
    
    /**
     * Initializes and returns Doctrine ORM entity manager
     *
     * @return \Doctrine\ORM\EntityManager
     * @todo Resource configurator like http://framework.zend.com/wiki/x/0IAbAQ
     */
    protected function _initDoctrineORMEntityManager()
    {
        #$autoloader = Zend_Loader_Autoloader::getInstance();
        
        require_once APPLICATION_PATH . '/../library/Doctrine/Common/ClassLoader.php';
        $doctrineAutoloader = new \Doctrine\Common\ClassLoader('Doctrine', APPLICATION_PATH . '/../library');
        $doctrineAutoloader->register();
        #$autoloader->pushAutoloader(array($doctrineAutoloader, 'loadClass'), 'doctrine');
        
        $cache = new Doctrine\Common\Cache\ArrayCache;
        $config = new Configuration;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver( APPLICATION_PATH . '/default/models/base/' );
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir( APPLICATION_PATH . '/default/models/proxies' );
        $config->setProxyNamespace('Doctrine\Proxies');

        $config->setAutoGenerateProxyClasses(true);

        $connectionOptions = array(
            'driver' => 'pdo_mysql',
            'user' => 'root',
            'password' => '',
            'dbname' => 'skeleton'
        );

        $_em = EntityManager::create($connectionOptions, $config);
        
        # get registery
        $registry = Zend_Registry::getInstance();

        # save new database adapter to registry
        $registry->doctrine->_em = $_em; 
    }

}

