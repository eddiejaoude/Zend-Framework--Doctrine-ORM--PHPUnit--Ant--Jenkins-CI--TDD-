<?php

/**
 * PasswordController
 * 
 * @author Koen Huybrechts
 * @package Auth Module 
 */
class Auth_PasswordController extends Auth_BaseController {

    /**
     * Initialisation method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function init() {
        parent::init();
    }

    /**
     * initiates before any action is dispatched
     *
     * @param	void
     * @return	void
     */
    public function preDispatch() {
        
    }

    /**
     * The default method
     */
    public function indexAction() {
        
    }

    /**
     * Send a new password to the emailaddress of the user
     * 
     * @author	Koen Huybrechts
     * @param	void
     * @return	void
     */
    public function forgotAction() {
        # if the user is logged in, they can not reset the password
        if (Zend_Auth::getInstance()->hasIdentity()) {
            # redirect password update page
            $this->_helper->redirector('update', 'password', 'auth');
        }

        # Get form
        $this->passwordForm = new Auth_Form_PasswordReset();

        $send = $this->sendPassword();

        #send to view
        $this->view->passwordForm = $send;
    }

    /**
     * The user can change his password
     * 
     * @author	Koen Huybrechts
     * @param	void
     * @return	void
     */
    public function updateAction() {
        # if the user is NOT logged in, they can not update the password
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            # redirect password update page
            $this->_helper->redirector('index', 'login', 'auth');
        }

        #Get form
        $this->updateForm = new Auth_Form_PasswordUpdate();

        $send = $this->updatePassword();

        #Send to view
        $this->view->updateForm = $send;
    }

    public function sendPassword() {
        #get form
        $form = $this->passwordForm;

        if ($this->_request->isPost()) {
            # get params
            $data = $this->_request->getPost();

            # check validate form
            if ($form->isValid($data)) {
                # attempt to resend password
                $user = $this->_em->getRepository('Auth_Model_Account')->findOneBy(array('email' => (string) $data['email']));

                if (count($user) === 1) {
                    $password = $this->_em->getRepository('Auth_Model_Account')->generatePassword($this->_registry->config->auth->password->length);

                    $user->setPassword($password, $this->_registry->config->auth->hash);
                    $this->_em->flush();

                    # send email
                    $emailReset = new Zend_Mail();
                    $emailReset->addTo($user->getEmail(), $user->getName());
                    $emailReset->setSubject('Password Reset');
                    // @ToDo Create a view file with an email template
                    $emailReset->setBodyText('New Password: ' . $password);

                    $emailReset->setFrom($this->_config->system->email->address, $this->_config->system->email->name);
                    if ($emailReset->send()) {
                        # Record event
                        $this->_helper->event->record('reset password', $user->getId());
                        $this->_flashMessenger->addMessage('A new password has been sent to ' . $user->getEmail());
                        $this->_helper->redirector('index', 'index', 'default');
                    }
                } else {
                    # Record event
                    // $this->_helper->event->record('reset password failed'); // removed because no account to log against
                    $this->_flashMessenger->addMessage('Sending failed'); 
                    $this->_helper->redirector('forgot', 'password', 'auth');
                }
            } else {
                # populate form
                $form->populate($data);
            }
        }
        return $form;
    }

    public function updatePassword() {
        #Get Form
        $form = $this->updateForm;

        if ($this->_request->isPost()) {
            # get params
            $data = $this->_request->getPost();

            $form->getElement('newPassword')
                    ->addValidator('NotIdentical', false, array('token' => $data['currentPassword']))
                    ->addValidator('stringLength', false, array($this->_registry->config->auth->password->length, 100));
            $form->getElement('confirmPassword')
                    ->addValidator('Identical', false, array('token' => $data['newPassword']));

            # check validate form
            if ($form->isValid($data)) {
                # attempt update the password
                $user = $this->_em->getRepository('Auth_Model_Account')->findOneBy(array('id' => Zend_Auth::getInstance()->getIdentity()->getId()));

                // @Todo Create one function where we can generate the correct hash
                if (count($user) === 1 && hash('SHA256', $this->_registry->config->auth->hash . $data['currentPassword']) == $user->getPassword()) { //User exists and posted current password matches the saved password
                    # Set new password
                    $user->setPassword($data['newPassword'], $this->_registry->config->auth->hash);
                    $this->_em->flush();

                    # Record event
                    $this->_helper->event->record('update password', Zend_Auth::getInstance()->getIdentity()->getId());

                    # Provide feedback
                    $this->_flashMessenger->addMessage('Your password has been updated'); // move to view
                    # Redirect to the secure page
                    $this->_helper->redirector('index', 'account', 'auth');
                } else {

                    # Record event
                    $this->_helper->event->record('update password failed', Zend_Auth::getInstance()->getIdentity()->getId());

                    $this->_flashMessenger->addMessage('Updating password failed'); // move to view
                    $this->_helper->redirector('index', 'index', 'default');
                }
            } else {
                # populate form
                $form->populate($data);
            }
        }
        return $form;
    }

}