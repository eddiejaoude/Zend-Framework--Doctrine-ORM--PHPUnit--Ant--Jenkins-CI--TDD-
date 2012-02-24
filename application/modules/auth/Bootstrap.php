<?php
/**
 * Auth Bootstrap
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */
class Auth_Bootstrap extends Zend_Application_Module_Bootstrap
{

    /**
     * Auto load default module classes
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           object $moduleLoader
     *
     */
    protected function _initAutoload()
    {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
                    'namespace' => 'Auth_',
                    'basePath' => APPLICATION_PATH . '/modules/auth'));

        $moduleLoader->addResourceType('controllerhelper',
            'controllers/helpers', 'Controller_Helper');

        return $moduleLoader;
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
        $config = new Zend_Config_Ini( dirname(__FILE__) .
                DIRECTORY_SEPARATOR . 'configs' .
                DIRECTORY_SEPARATOR . 'auth.ini', APPLICATION_ENV);

        # get registery
        $this->_registry = Zend_Registry::getInstance();

        # save config to registry
        $this->_registry->config->auth = $config;
    }

    protected function _initActionHelpers()
    {

        // path for module-specific controller helpers
        Zend_Controller_Action_HelperBroker::addPath( APPLICATION_PATH . '/modules/auth/controllers/helpers', 'Auth_Controller_Helper_');

        // initialize the event helper with entity manager
        $this->bootstrap('autoload');
        $application = $this->getApplication();
        $application->bootstrap('doctrine');
        if (isset($application->_registry->doctrine->_em)){
            Auth_Controller_Helper_Event::$defaultEntityManager = $application->_registry->doctrine->_em;
        }
    }
}

