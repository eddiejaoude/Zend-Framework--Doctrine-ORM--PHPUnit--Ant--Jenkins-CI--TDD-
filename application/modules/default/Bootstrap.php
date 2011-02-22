<?php

class Default_Bootstrap extends Zend_Application_Module_Bootstrap {

    protected function _initAutoload() {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
                    'namespace' => 'Default_',
                    'basePath' => APPLICATION_PATH . '/modules/default'));
        return $moduleLoader;
    }

    protected function _initBaseController() {
        # base controller - can this be moved and autoloaded?
        include_once('controllers/BaseController.php');
    }

}

