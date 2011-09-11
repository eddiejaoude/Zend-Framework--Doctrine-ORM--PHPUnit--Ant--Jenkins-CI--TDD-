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
    protected $_flashMessenger = NULL;

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
        $this->_registry = Zend_Registry::getInstance();

        # clone objects for ease of use
        $this->_em     = $this->_registry->doctrine->_em;
        $this->_logger = $this->_registry->logger;

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
    public function  postDispatch()
    {
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