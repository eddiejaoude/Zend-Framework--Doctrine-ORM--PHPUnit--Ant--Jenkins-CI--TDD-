<?php
/**
 * Auth Bootstrap
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */
class Install_Bootstrap extends Zend_Application_Module_Bootstrap {

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
                    'namespace' => 'Install_',
                    'basePath' => APPLICATION_PATH . '/modules/install'));
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
        include_once('controllers/InstallBaseController.php');
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
                DIRECTORY_SEPARATOR . 'install.ini', APPLICATION_ENV);

        # get registery
        $this->_registry = Zend_Registry::getInstance();
        
        # save config to registry
        $this->_registry->config->install = $config;
    }

    protected function _initActionHelpers()
    {
        Zend_Controller_Action_HelperBroker::addPath( APPLICATION_PATH . '/modules/install/controllers/helpers', 'Install_Controller_Helper_');
    }


}

