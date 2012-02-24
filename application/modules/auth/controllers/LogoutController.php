<?php
/**
 * Auth Logout Controller
 *
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */
class Auth_LogoutController extends Zend_Controller_Action
{

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
        parent::init();
    }

    /**
     * initiates before any action is dispatched
     *
     * @param	void
     * @return	void
     */
    public function preDispatch()
    {
        # if the user is not logged in, they can not log out
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            # redirect login page
            $this->_helper->redirector('index', 'index', 'default');
        }
    }

    /**
     * initiates after any action is dispatched
     *
     * @param	void
     * @return	void
     */
    public function postDispatch()
    {
        parent::postDispatch();
    }

    /**
     * default method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function indexAction()
    {
        # record event
        $this->_helper->event->record('logged out', Zend_Auth::getInstance()->getIdentity()->getId());

        # clears users identity
        Zend_Auth::getInstance()->clearIdentity();

        # display to user
        $this->getRequest()->_flashMessenger->addMessage('You have been logged out');

        # redirect
        $this->_helper->redirector('index', 'login', 'auth');
    }

    /**
     * Impersonate method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function impersonateAction()
    {

    }

}

