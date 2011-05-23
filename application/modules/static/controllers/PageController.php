<?php
/**
 * Page Controller: The controller to show a static page
 *
 * @author        Koen Huybrechts
 * @package       Static Module
 *
 */
class Static_PageController extends BaseController
{

    /**
     * Initialisation method
     *
     * @author          Koen Huybrechts
     * @param           void
     * @return           void
     *
     */
    public function init()
    {
        parent::init();
    }

    /**
     * post dispatch method
     *
     * @author          Koen Huybrechts
     * @param           void
     * @return           void
     *
     */
    public function  postDispatch()
    {
        parent::postDispatch();
    }

    /**
     * default method
     *
     * @author          Koen Huybrechts
     * @param           void
     * @return           void
     *
     */
    public function indexAction()
    {
    	
    	
    	$request = $this->getRequest();
    	
    	$page = $this->_em->getRepository('Default_Model_Page')->findOneBy(
	    		array(
	    			'slug' => (string) $request->getParam('slug'),
	    			'language' => (string) $request->getParam('lang')
	    		)
    		);
    	$widgets = Array();
    	$widgets = $this->_helper->widgets($page->getLayout());
    	
        Zend_Debug::dump($widgets); die();
    }
    
    public function viewAction()
    {
    	
    }
    
    public function widgetAction()
    {
		# Get the default locale from the registry
	    $locale = Zend_Registry::get('locale');
    	$translate = Zend_Registry::get('Zend_Translate');
    	$extraLanguage = new Zend_Translate('ini', APPLICATION_PATH . '/modules/static/languages/' . $locale->getLanguage() . '.ini', $locale->getLanguage());
    	$translate->addTranslation($extraLanguage);
    	Zend_Registry::set('Zend_Translate', $translate);
    	
    	
    	$this->view->test = 'Dit is de var-waarde';
    }
    
    public function saveAction()
    {
    	echo 'ok'; die;
    }
    


}

