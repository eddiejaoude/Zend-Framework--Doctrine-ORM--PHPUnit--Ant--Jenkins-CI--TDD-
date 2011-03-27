<?php
/**
 * Auth Login Controller
 *
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */
class Auth_AccountController extends Auth_BaseController
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
     * default method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function indexAction() {
        $accounts = $this->_em->getRepository('Auth_Model_Account')->findAll();
       
        $this->view->accounts = $accounts;
    }
    


}