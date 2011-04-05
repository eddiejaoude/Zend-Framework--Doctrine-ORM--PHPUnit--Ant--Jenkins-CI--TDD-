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
                    $model = new Auth_Model_Account();
                    $accountModel = $this->_em->getRepository('Auth_Model_Account');
                    $email = $accountModel->checkEmail($data);
                    
                    if ($email instanceof  Auth_Model_Account) {
				        # get config
				        /**
				         * How can we make this better? So you don't have to get the config file manually?
				         */
				        $this->_config = new Zend_Config_Ini(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'modules' .
				                DIRECTORY_SEPARATOR . $this->getRequest()->getModuleName() . DIRECTORY_SEPARATOR . 'config' .
				                DIRECTORY_SEPARATOR . $this->getRequest()->getModuleName() . '.ini', APPLICATION_ENV);
				                
                    	$password = substr(md5(rand().rand()), 0, $this->_config->password->minlength);
                    	
                    	$accountModel->setPassword($password);
                    	
                    	Zend_Debug::dump($password); die();
                    	
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
