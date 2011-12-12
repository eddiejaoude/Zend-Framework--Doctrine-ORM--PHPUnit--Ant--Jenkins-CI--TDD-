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
    public function preDispatch()
    {
        # if the user is logged in, they can not login again
        if (Zend_Auth::getInstance()->hasIdentity()) {
            # redirect login page
            $this->_helper->redirector('index', 'index', 'default');
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
     * default method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function indexAction()
    {
        # load form
        $this->loginForm = new Auth_Form_Login;

        $save = $this->authenticate();

        # send to view
        $this->view->loginForm = $save['form'];
        $this->view->alert     = $save['alert'];
    }
    /**
     * authentication method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function authenticate ()
    {
        # get form
        $form = $this->loginForm;
        if ($this->_request->isPost()) {
            # get params
            $data = $this->_request->getPost();
            # check validate form
            if ($form->isValid($data)) {
                # attempt to authentication
                $authenticate = new Custom_Auth_Adapter(
                $this->_em->getRepository('Auth_Model_Account'),
                $this->_registry->config->auth->hash, $data);
                $save = Zend_Auth::getInstance()->authenticate($authenticate);
                if (Zend_Auth::getInstance()->hasIdentity()) {
                    $this->_flashMessenger->addMessage('Logged in successfully');
                    # record event
                    $this->_helper->event->record(
                    'logged in',
                    Zend_Auth::getInstance()->getIdentity()
                        ->getId());
                    # send to dashboard/user page
                    $this->_helper->redirector('index',
                    'account', 'auth');
                } else {
                    $alert = array('Logged in failed');
                }
            }
            $form->populate($data);
        }
        return array('form' => $form, 'alert' => empty($alert) ? NULL : $alert);
    }


    /**
     * Impersonate method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function impersonateAction()
    {

    }

}
