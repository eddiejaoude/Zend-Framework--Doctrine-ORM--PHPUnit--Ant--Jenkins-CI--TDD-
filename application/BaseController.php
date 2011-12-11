<?php

/**
 * Application Base Controller
 *
 * Base controller for application
 *
 * @author          Eddie Jaoude
 * @package       Application Module
 *
 */
abstract class Application_BaseController extends Zend_Controller_Action
{

    /**
     * Flash messenger object helper
     *
     * @author          Eddie Jaoude
     * @param           object $_flashMessenger
     *
     */
    protected $_flashMessenger = NULL;

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
        # get application objects
        $this->_registry = Zend_Registry::getInstance();

        # clone objects for ease of use
        $this->_em     = $this->_registry->doctrine->_em;
        $this->_logger = $this->_registry->logger;

        # flash messenger
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        
        # load theme engine
        $this->_themes();
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

        if (empty($this->view->alert))
        {
            $this->view->alert = $this->_flashMessenger->getMessages();
        }
        else
        {
            if (!is_array($this->view->alert)) {
                throw new Exception('Alert string $this->view->alert must be an array');
            }
        }
    }
    
    /**
     * Themes
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return          void
     *
     */
    protected function _themes()
    {
        # get theme
        $request = $this->getRequest();
        $theme = $request->getParam('theme');
        
        # set session - to make persistent for registered users this should be save as a setting in DB
        $session = new Zend_Session_Namespace('theme');
        if (!empty($theme)) {
            $session->theme = $theme;
        } else {
            if (empty($session->theme)) { $session->theme = $this->_registry->config->application->theme->default->layout; }
            $theme = $session->theme;
        }
        
        # load theme        
        $this->_helper->layout->setLayout($theme);
        
        # set link for theme switching
        $this->view->themelink = '/' . $this->getRequest()->getModuleName() . '/' .
                                    $this->getRequest()->getControllerName() . '/' .
                                    $this->getRequest()->getACtionName();
        
    }

}