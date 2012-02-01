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
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Doctype
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return          void
     *
     */
    protected function _initDoctype()
    {
        $doctypeHelper = new Zend_View_Helper_Doctype();
        $doctypeHelper->doctype('XHTML1_STRICT');
    }

    /**
     * Title
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return          void
     *
     */
    protected function _initDoctitle()
    {
        $view = new Zend_View($this->getOptions());
        $view->headTitle('Zend Framework (ZF) & Doctrine2 Skeleton/Baseline');
    }

    /**
     * Default  View helpers
     *
     * @TODO: This needs to be updated to be dynamic for current module or moved to each module
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return          void
     *
     */
    protected function _initDefaultHelpers()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->addHelperPath( APPLICATION_PATH . '/modules/default/views/helpers', 'Default_View_Helper');
    }

    /**
     * Application  Base Controller & model
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return          void
     *
     */
    protected function _initApplicationBase()
    {
        include_once(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'BaseController.php');
    }

    /**
     * Configuration
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return          void
     *
     */
    protected function _initConfig()
    {
        # get config
        $config = new Zend_Config_Ini(APPLICATION_PATH .
                DIRECTORY_SEPARATOR . 'configs' .
                DIRECTORY_SEPARATOR . 'application.ini', APPLICATION_ENV);

        # get registery
        $this->_registry = Zend_Registry::getInstance();

        # save new database adapter to registry
        $this->_registry->config              = new stdClass();
        $this->_registry->config->application = $config;
    }
    
    /**
     * ZFDebug
     * 
     * GitHub project https://github.com/jokkedk/ZFDebug
     *
     */
    protected function _initZFDebug()
    {
        if ('development' == APPLICATION_ENV) {
            $autoloader = Zend_Loader_Autoloader::getInstance();
            $autoloader->registerNamespace('ZFDebug');

            $options = array(
                'plugins' => array('Variables', 
                                   //'Database' => array('adapter' => $db), 
                                   'File' => array('basePath' => APPLICATION_PATH . 
                                                            '..'),
                                   //'Cache' => array('backend' => $cache->getBackend()), 
                                   'Exception'
                                )
            );
            $debug = new ZFDebug_Controller_Plugin_Debug($options);

            $this->bootstrap('frontController');
            $frontController = $this->getResource('frontController');
            $frontController->registerPlugin($debug);
        }
    }

    /**
     * Tmp director
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return          void
     *
     */
    protected function _initTmpDirectory()
    {
        # check tmp directory is writable
        if (!is_writable($this->_registry->config->application->logs->tmpDir)) {
            throw new Exception('Error: tmp dir is not writable ( ' . $this->_registry->config->application->logs->tmpDir . '), check folder/file permissions');
        }
    }

    /**
     * Logger
     * 
     * @EXAMPLE: $logger->log('This is a log message!', Zend_Log::INFO);
     * @EXAMPLE: $logger->info('This is a log message!');
     * 
     * From anywhere use...
     * @EXAMPLE: Zend_Registry::get('logger')->log('This is a log message!', Zend_Log::INFO);
     * 
     * EMERG   = 0;  // Emergency: system is unusable
     * ALERT   = 1;  // Alert: action must be taken immediately
     * CRIT    = 2;  // Critical: critical conditions
     * ERR     = 3;  // Error: error conditions
     * WARN    = 4;  // Warning: warning conditions
     * NOTICE  = 5;  // Notice: normal but significant condition
     * INFO    = 6;  // Informational: informational messages
     * DEBUG   = 7;  // Debug: debug messages
     * 
     * REQUIREMENTS: FirePHP & FireBug (firephp enabled & net tab enabled on firebug)
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return          void
     *
     */
    protected function _initLogger()
    {
        # log file
        $error_log = $this->_registry->config->application->logs->tmpDir . DIRECTORY_SEPARATOR . $this->_registry->config->application->logs->error;

        # create log file if does not exist
        if (!file_exists($error_log)) {
            $date = new Zend_Date;
            file_put_contents($error_log, 'Error log file created on: ' . $date->toString('YYYY-MM-dd HH:mm:ss') .  "\n\n");
        }

        # check log file is writable
        if (!is_writable($error_log)) {
            throw new Exception('Error: log file is not writable ( ' . $error_log . '), check folder/file permissions');
        }

        # create logger object
        if ('development' == APPLICATION_ENV) {
            $writer = new Zend_Log_Writer_Firebug();
        } else {
            $writer = new Zend_Log_Writer_Stream($error_log);
        }
        $logger = new Zend_Log($writer);

        $this->_registry->logger = $logger;
    }

    /**
     * Initializes and returns Doctrine ORM entity manager
     *
     * @return \Doctrine\ORM\EntityManager
     * @todo Resource configurator like http://framework.zend.com/wiki/x/0IAbAQ
     */
    protected function _initDoctrine()
    {
        # doctrine loader
        require_once (APPLICATION_PATH .
            DIRECTORY_SEPARATOR . '..' .
            DIRECTORY_SEPARATOR . 'library' .
            DIRECTORY_SEPARATOR . 'Doctrine' .
            DIRECTORY_SEPARATOR . 'Common' .
            DIRECTORY_SEPARATOR . 'ClassLoader.php'
        );
        $doctrineAutoloader = new \Doctrine\Common\ClassLoader('Doctrine', APPLICATION_PATH .
                DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'library'
        );
        $doctrineAutoloader->register();

        # configure doctrine
        $cache  = new Doctrine\Common\Cache\ArrayCache;
        $config = new Configuration;
        $config->setMetadataCacheImpl($cache);
        $driverImpl = $config->newDefaultAnnotationDriver( APPLICATION_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'models' );
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir( APPLICATION_PATH );
        $config->setProxyNamespace('Proxies');
        $config->setAutoGenerateProxyClasses(TRUE);

        # database connection
        $this->_registry->doctrine      = new stdClass();
        $this->_registry->doctrine->_em = EntityManager::create($this->_registry->config->application->doctrine->connection->toArray(), $config);
    }
    

}
