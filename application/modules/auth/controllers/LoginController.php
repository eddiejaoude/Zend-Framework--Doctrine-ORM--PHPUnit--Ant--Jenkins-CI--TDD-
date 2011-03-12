<?php
/**
 * Auth Login Controller
 *
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */
class Auth_LoginController extends Auth_BaseController
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
        # load form
        $form = new Auth_Form_Login;

        # send to view
        $this->view->loginForm = $form;
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
