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
    	$this->view->test = 'Dit is de var-waarde';
    }
    


}

