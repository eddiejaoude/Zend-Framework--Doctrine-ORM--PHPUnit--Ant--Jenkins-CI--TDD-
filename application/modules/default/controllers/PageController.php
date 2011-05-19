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
        Zend_Debug::dump($this->getRequest()->getParams()); die();
    }
    
    public function viewAction()
    {
    	
    }
    


}

