<?php

/**
 * Alert plugin
 *
 * @author          Eddie Jaoude
 * @package       Application Module
 *
 */
class Application_Plugin_Alert extends Zend_Controller_Plugin_Abstract {

    /**
     * Pre dispatch
     *
     * @author          Eddie Jaoude
     * @param           Zend_Controller_Request_Abstract $request
     * @return           void
     *
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        
    }

    /**
     * Post dispatch
     *
     * @author          Eddie Jaoude
     * @param           Zend_Controller_Request_Abstract $request
     * @return           void
     *
     */
    public function postDispatch(Zend_Controller_Request_Abstract $request) {
        $layout = Zend_Layout::getMvcInstance();
        $view = $layout->getView();

        $flashMessenger = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
        
        $alert = $flashMessenger->getMessages();
        if (!empty($alert)) { 
            $view->alert = $alert;
        }
    }

}