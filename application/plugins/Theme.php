<?php
/**
 * Alert plugin
 *
 * @author        David Weinraub <david@Weinraub.com>
 * @package       Application Module
 *
 */
class Application_Plugin_Theme extends Zend_Controller_Plugin_Abstract
{

    /**
     * Pre dispatch
     *
     * @author          Eddie Jaoude
     * @param           Zend_Controller_Request_Abstract $request
     * @return           void
     *
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        // echo "<pre>" . var_dump($request) . "</pre>";
        // die(__FILE__ . "(" . __LINE__ . ") :: " . __FUNCTION__ . " :: message");


        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()){
            return;
        }
        $user = $auth->getIdentity();
        $theme = $user->getTheme();
        $this->setLayout($theme);
        $this->addFormToView($theme);

    }

    /**
     * Post dispatch
     *
     * @author          Eddie Jaoude
     * @param           Zend_Controller_Request_Abstract $request
     * @return           void
     *
     */
    public function postDispatch(Zend_Controller_Request_Abstract $request)
    {
    }
    
    /**
     * Set the layout based upon theme
     * 
     * @param string $theme 
     */
    protected function setLayout($theme)
    {
        Zend_Layout::getMvcInstance()->setLayout($theme);
    }
    
    /**
     * Set a theme selector form in the view
     * 
     * @param type $theme 
     */
    protected function addFormToView($theme)
    {
        $form = new Auth_Form_ThemeSelect();
        
        $form->setDefaults(array(
            'theme' => $theme,
            'redirectUrl' => $_SERVER['REQUEST_URI'],
        ));
        Zend_Controller_Action_HelperBroker::getExistingHelper('ViewRenderer')->view->formThemeSelect = $form;        
    }
}