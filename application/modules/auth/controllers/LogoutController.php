<?php
/**
 * Auth Logout Controller
 *
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */
class Auth_LogoutController extends Auth_BaseController
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
    public function preDispatch() {
        # if the user is not logged in, they can not log out
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            # redirect login page
            $this->_helper->redirector('index', 'index', 'default');
        }
    }

    /**
     * default method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function indexAction() {
        # clears users identity
        Zend_Auth::getInstance()->clearIdentity();

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
    public function impersonateAction() {
        
    }

}

