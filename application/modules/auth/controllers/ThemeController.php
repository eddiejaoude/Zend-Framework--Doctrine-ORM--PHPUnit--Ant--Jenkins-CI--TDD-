<?php
/**
 * Auth Theme Controller
 *
 *
 * @author          David Weinraub <david@papayasoft.com>
 * @package       Auth Module
 *
 */
class Auth_ThemeController extends Auth_BaseController
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
        # if the user is logged in, they can not register again
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            # redirect login page
            $this->_helper->redirector('index', 'login', 'auth');
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
     * Update the user's current and default theme
     *
     * @author          David Weinraub <david@weinraub.com>
     * @param           void
     * @return           void
     *
     */
    public function updateAction()
    {
        # load form
        $form = new Auth_Form_ThemeSelect();

        $message = NULL;
        if ($this->_request->isPost()) {
            
            if ($form->isValid($this->_request->getPost())) {
                
                $data = $form->getValues();
                
                $user = $this->_em->getRepository('Auth_Model_Account')->findOneBy(array(
                    'id' => Zend_Auth::getInstance()->getIdentity()->getId(),
                ));
                $user->setTheme($data['theme']);
                
                // persist to db
                $this->_em->persist($user);
                $this->_em->flush();

                // update the local identity
                Zend_Auth::getInstance()->getStorage()->write($user);

                // add an event, just for fun
                $this->_helper->event->record(sprintf('Changed theme to %s', $data['theme']), $user->getId());
                                
                // redirect to original location
                $this->_helper->_redirector->gotoUrlAndExit($data['redirectUrl']);
            }
        }
        $this->view->form = $form;
    }

}

