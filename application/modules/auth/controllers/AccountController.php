<?php
/**
 * Auth Login Controller
 *
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */
class Auth_AccountController extends Zend_Controller_Action
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
        # if the user is not logged in, they can not access secure pages
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            # redirect login page
            $this->_helper->redirector('denied', 'index', 'auth');
        }
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

    }

    /**
     * history method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function eventAction()
    {
        # get account events
        $events = $this->getRequest()->_em->getRepository('Auth_Model_AccountEvent')->findBy(array('account_id' => Zend_Auth::getInstance()->getIdentity()->getId()));

        # send to view
        $this->view->events = $events;
    }



}