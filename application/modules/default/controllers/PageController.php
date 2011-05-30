<?php
/**
 * Page Controller: The default controller to process a request
 *
 * @author        Koen Huybrechts
 * @package       Default Module
 *
 */
class PageController extends BaseController
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
    		
    		//Zend_Debug::dump(Zend_Controller_Front::getInstance()->getRouter()->getCurrentRouteName()); die;
    		//Zend_Debug::dump($this->_helper->templateSelector()); die;
    	$this->_helper->layout->disableLayout();
    	
    	$path = APPLICATION_PATH . DIRECTORY_SEPARATOR .
    		'..' . DIRECTORY_SEPARATOR . 
    		'template' . DIRECTORY_SEPARATOR . 
    		'frontend' . DIRECTORY_SEPARATOR . 
    		'page-layouts' . DIRECTORY_SEPARATOR;
    	
    	$layoutPath = APPLICATION_PATH . DIRECTORY_SEPARATOR .
    		'..' . DIRECTORY_SEPARATOR . 
    		'template' . DIRECTORY_SEPARATOR . 
    		'frontend' . DIRECTORY_SEPARATOR . 
    		'layouts' . DIRECTORY_SEPARATOR;
    	
    	$request = $this->getRequest();
    	
    	$page = $this->_em->getRepository('Default_Model_Page')->findOneBy(
	    		array(
	    			'slug' => (string) $request->getParam('slug'),
	    			'language' => (string) $request->getParam('lang')
	    		)
    		);
    	$this->view->content = $this->_helper->widgets($path, $page->getLayout());
    	$this->view->page = $this->_helper->widgets($layoutPath, 'frontend.phtml');
    	$this->view->setScriptPath(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'scripts');
    }
    
    public function viewAction()
    {
    	
    }
    


}

