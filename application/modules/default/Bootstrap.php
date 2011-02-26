<?php
/**
 * Default Bootstrap
 *
 * @author          Eddie Jaoude
 * @package       Default Module
 *
 */
class Default_Bootstrap extends Zend_Application_Module_Bootstrap {

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
                    'namespace' => 'Default_',
                    'basePath' => APPLICATION_PATH . '/modules/default'));
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
        include_once('controllers/BaseController.php');
    }

}

