<?php

/**
 * Default Base Controller
 *
 * Base controller to Default Module
 *
 * @author          Eddie Jaoude
 * @package       Default Module
 *
 */
abstract class BaseController extends Zend_Controller_Action {

        /**
     * Initialisation method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function init()
    {
        # get doctrine entity manager
        $registry = Zend_Registry::getInstance();
        $this->_em = $registry->doctrine->_em;
        $this->_logger = $registry->logger;
    }
    

}
?>
