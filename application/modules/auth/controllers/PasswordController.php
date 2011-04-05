<?php
/**
 * PasswordController
 * 
 * @author Koen Huybrechts
 * @package Auth Module 
 */

class Auth_PasswordController extends Auth_BaseController
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
     * The default method
     */
    public function indexAction ()
    {
    }
    
    public function forgotAction()
    {
    	# Get form
        $this->passwordForm = new Auth_Form_PasswordReset();
        
        $send = $this->sendPassword();
        
        #send to view
        $this->view->passwordForm = $send['form'];
        $this->view->alert = $send['alert'];
    }
    
    public function sendPassword()
    {
    	#get form
    	$form = $this->passwordForm;
    	
    	if ($this->_request->isPost()) {
            # get params
            $data = $this->_request->getPost();

            # check validate form
            if ($form->isValid($data)) {
                    # attempt to authentication
                    $adapter = new Custom_Auth_Adapter($this->_em->getRepository('Auth_Model_Account'), $this->_hash, $data);
                    $save = $adapter->checkEmail();
                    
                    if ($save == 'SUCCESS') {
                        # send email
                        
                    	
                    	
                    	#redirect to frontpage
                        $this->_helper->redirector('index', 'index', 'auth');
                    } else {
                        $alert = 'Sending failed: Invalid details'; // move to view
                    }
            } 
            # populate form
            $form->populate($data);
        }
        return array('form' => $form, 'alert' => empty($alert) ? null : $alert );
    }
}
