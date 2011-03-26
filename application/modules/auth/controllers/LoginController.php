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
     * initiates before any action is dispatched
     *
     * @param	void
     * @return	void
     */
    public function preDispatch() {
        # if the user is logged in, they can not register again
        if (Zend_Auth::getInstance()->hasIdentity()) {
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
        # load form
        $this->loginForm = new Auth_Form_Login;

        $save = $this->authenticate();

        # send to view
        $this->view->loginForm = $save['form'];
        $this->view->alert = $save['alert'];
    }

    /**
     * authentication method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public  function authenticate() {
        $form = $this->loginForm;
        if ($this->_request->isPost()) {
            # get params
            $data = $this->_request->getPost();
            if ($form->isValid($data)) {
                    $hash = 'd2e07fd2d1fb1dd9339c410e024cc36164ccf5790b2b138380293dffb45e1a47';
                    $authenticate = new Custom_Auth_Adapter($this->_em->getRepository('Auth_Model_Account'), $hash, $data);
                    $save = Zend_Auth::getInstance()->authenticate($authenticate);
                    if (Zend_Auth::getInstance()->hasIdentity()) {
                        # send to dashboard/user page
                        $this->_helper->redirector('index', 'index', 'auth');
                    } else {
                        $alert = 'Login failed: Invalid details'; // move to view
                    }
            } 
            # populate form
            $form->populate($data);
        }
        return array('form' => $form, 'alert' => empty($alert) ? null : $alert );
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
