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
    
    /**
     * Discover the requested language and set this language in locale and translate
     */
    protected function _initRoute()
    {
    	
        $this->bootstrap('frontController');

        /* @var $frontcontroller Zend_Controller_Front */
        $frontcontroller = $this->getResource('frontController');
		$frontcontroller->registerPlugin(new Custom_Controller_Plugin_Language());
		
        $router = $frontcontroller->getRouter();
        $router->addRoute(
            'all',
            new Zend_Controller_Router_Route('*',
                array('controller' => 'page',
                      'action'     => 'index')
            )
        );
        
    }
    
    /**
     * Add the helper path
     */
    protected function _initHelperPath()
    {
    	Zend_Controller_Action_HelperBroker::addPath(
        APPLICATION_PATH. '/modules/default/controllers/helpers');
    }

}

