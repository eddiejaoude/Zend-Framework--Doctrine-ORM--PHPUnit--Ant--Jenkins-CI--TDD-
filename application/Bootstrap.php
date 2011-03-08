<?php
/**
 * Application Bootstrap
 *
 * @author          Eddie Jaoude
 * @package       Default Module
 *
 */
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
        // Get Doctrine options
        $optionsDoctrine = $this->getOption('doctrine');

        // Create ORM configuration
        $config = new \Doctrine\ORM\Configuration();

        // Proxy configuration
        $config->setProxyDir(__DIR__ . '/../../Doctrine/Proxy');
        $config->setProxyNamespace('Deftek\ScrumTools\Doctrine\Proxy');
        $config->setAutoGenerateProxyClasses($optionsDoctrine['autoGenerateProxyClasses']);

        // Mapping configuration
        $driverImpl = new \Doctrine\ORM\Mapping\Driver\XmlDriver(__DIR__ . '/../library/Toko/Doctrine/Map');
        $config->setMetadataDriverImpl($driverImpl);

        // Caching configuration
        $cacheImpl = new $optionsDoctrine['cacheImplementation']();
        $config->setMetadataCacheImpl($cacheImpl);
        $config->setQueryCacheImpl($cacheImpl);
        $config->setResultCacheImpl($cacheImpl);

        // Create event manager
        $eventManager = new \Doctrine\Common\EventManager();

        // Initialize MySQL character set and collation
        $eventManager->addEventSubscriber(new \Doctrine\DBAL\Event\Listeners\MysqlSessionInit());

        // Obtain entity manager
        $entityManager = \Doctrine\ORM\EntityManager::create(
            $optionsDoctrine['connection'],
            $config,
            $eventManager
            );
        // Return entity manager
        return $entityManager;
    }

}

