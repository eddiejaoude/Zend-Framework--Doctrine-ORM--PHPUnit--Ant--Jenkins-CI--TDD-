<?php

/**
 * Application Base Controller
 *
 * Base controller for application
 *
 * @author          Eddie Jaoude
 * @package       Application Module
 *
 */
abstract class Application_BaseController extends Zend_Controller_Action
{

    /**
     * Flash messenger object helper
     *
     * @author          Eddie Jaoude
     * @param           object $_flashMessenger
     *
     */
    protected $_flashMessenger = null;

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
        # get application objects
        $this->registry = Zend_Registry::getInstance();
        $this->_em = $this->registry->doctrine->_em;
        $this->_logger = $this->registry->logger;

        # flash messenger
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
    }

    /**
     * post dispatch method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function  postDispatch() {
        parent::postDispatch();

        if (empty($this->view->alert))
        {
            $this->view->alert = $this->_flashMessenger->getMessages();
        }
        else
        {
            if (!is_array($this->view->alert)) {
                throw new Exception('Alert string $this->view->alert must be an array');
            }
        }
    }

}