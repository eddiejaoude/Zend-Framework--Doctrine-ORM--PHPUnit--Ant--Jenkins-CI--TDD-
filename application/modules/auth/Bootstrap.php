<?php
/**
 * Auth Bootstrap
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */
class Auth_Bootstrap extends Zend_Application_Module_Bootstrap {

    /**
     * Auto load default module classes
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           object $moduleLoader
     *
     */
    protected function _initAutoload() {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
                    'namespace' => 'Auth_',
                    'basePath' => APPLICATION_PATH . '/modules/auth'));
        return $moduleLoader;
    }

    /**
     * Load BaseController
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    protected function _initBaseController() {
        # base controller - can this be moved and autoloaded?
        require_once('controllers/AuthBaseController.php');
    }

    /**
     * Configuration
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return          void
     *
     */
    protected function _initConfig() {
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
        Zend_Controller_Action_HelperBroker::addPath( APPLICATION_PATH . '/modules/auth/controllers/helpers', 'Auth_Controller_Helper_');
        /*$controllersDir = Zend_Controller_Front::getInstance()->getControllerDirectory(strtolower($module));

        $prefix = implode('_', array_map('ucfirst', array($module,'controller','helper','')));
        $path = realpath(implode(DIRECTORY_SEPARATOR, array($controllersDir,'helpers')));

        Zend_Controller_Action_HelperBroker::addPath( $path, $prefix);*/
    }


}

