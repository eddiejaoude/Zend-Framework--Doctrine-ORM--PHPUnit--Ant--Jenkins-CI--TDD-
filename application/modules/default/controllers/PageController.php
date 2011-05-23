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
    	$request = $this->getRequest();
    	
    	$page = $this->_em->getRepository('Default_Model_Page')->findOneBy(
	    		array(
	    			'slug' => (string) $request->getParam('slug'),
	    			'language' => (string) $request->getParam('lang')
	    		)
    		);
    	$this->view->content = $this->_helper->widgets($page->getLayout());
    	$this->view->header = $this->_helper->widgets('_header.phtml');
    	$this->view->footer = $this->_helper->widgets('_footer.phtml');
    }
    
    public function viewAction()
    {
    	
    }
    


}

