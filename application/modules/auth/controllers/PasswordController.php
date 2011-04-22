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
                    # attempt to resend password
                    $email = $this->_em->getRepository('Auth_Model_Account')->findBy(array('email' => (string) $data['email']));
                    
                    if (count($email) === 1) {
                    	//@Todo Remove this line
                    	$this->_config = new Zend_Config_Ini(APPLICATION_PATH . 
                DIRECTORY_SEPARATOR . 'configs' .
                DIRECTORY_SEPARATOR . 'application.ini', APPLICATION_ENV);
                    	
                    	$email = $email[0];				                
                    	$password = $this->_em->getRepository('Auth_Model_Account')->generatePassword($this->_auth->password->length);
                    	
                    	$email->setPassword($password, $this->_auth->hash);
                    	$this->_em->flush();
                    	
                        # send email
                        $emailReset = new Zend_Mail();
                        $emailReset->addTo($email->getEmail(), $email->getName());
                        $emailReset->setSubject('Password Reset');
                        $emailReset->setBodyText('New Password: ' . $password);
                        
                        $emailReset->setFrom($this->_config->system->email->address, $this->_config->system->email->name);
                        Zend_Debug::dump($this->registry); die();
                        if($emailReset->send()) {
                        	$this->_flashMessenger->addMessage('A new password is send to ' . $email->getEmail());
                        }
                    } else {
                        $this->_flashMessenger->addMessage('Sending failed: Emailaddress unknown'); // move to view
                    }
            } else {
	            # populate form
	            $form->populate($data);
            }
        }
        return array('form' => $form, 'alert' => empty($alert) ? null : $alert );
    }
}
