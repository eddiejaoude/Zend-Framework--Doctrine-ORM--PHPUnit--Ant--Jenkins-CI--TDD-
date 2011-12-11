<?php
/**
 * Auth Login Controller
 *
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */
class Auth_AccountController extends Auth_BaseController
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
        # if the user is not logged in, they can not access secure pages
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            # redirect login page
            $this->_helper->redirector('denied', 'index', 'auth');
        }
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

    }

    /**
     * history method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function eventAction()
    {
        # get account events
        $events_query = $this->_em->createQueryBuilder()
                            ->select('ae')
                            ->from('Auth_Model_AccountEvent', 'ae')
                            ->where('ae.account_id = :account_id')
                            ->orderBy('ae.created_at', 'DESC')
                            ->setParameter('account_id', Zend_Auth::getInstance()->getIdentity()->getId());

        # pagination
        $paginator = new Custom_Paginator_DoctrineAdapter($events_query);
        $events =  new Zend_Paginator($paginator);
        $events->setItemCountPerPage($this->_request->getParam('limit', $this->_registry->config->application->pagination->limit));
        $events->setCurrentPageNumber($this->_request->getParam('page', 1));
        
        # send to view
        $this->view->events = $events;
    }



}