<?php
/**
 * Webservice Controller
 *
 * @author          Eddie Jaoude
 * @package       Default Module
 *
 */
class WebserviceController extends BaseController
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
        $schoolme = new Default_Model_Schoolme($this->getInvokeArg('bootstrap')->getResource('configWebServices')->schoolme->url);
        $data = $schoolme->search(array(
            'key' => '13208249444eba307037f9e2.6098849', 
            'county' => 'surrey',
            'start' => '0',
            'limit' => '3'
            )
        );

        # pagination
        $paginator = new Custom_Paginator_ObjectAdapter($data);
        $schools =  new Zend_Paginator($paginator);
        $schools->setItemCountPerPage($this->_request->getParam('limit', $this->_registry->config->application->pagination->limit));
        $schools->setCurrentPageNumber($this->_request->getParam('page', 1));

        $this->view->schools = $schools;
    }

}

