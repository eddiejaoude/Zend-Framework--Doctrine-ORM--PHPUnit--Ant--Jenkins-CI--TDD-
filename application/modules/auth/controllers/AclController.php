<?php
/**
 * Auth ACL Controller
 *
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */
class Auth_AclController extends Auth_BaseController
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
    public function preDispatch() {
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
    public function  postDispatch() {
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
    public function indexAction() {
        
    }

    /**
     * role  method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function roleAction() {
        #$modelRoles = $this->_em->createQuery('SELECT r, p FROM Auth_Model_Role r JOIN r.rolePrivileges p');
        $qb = $this->_em->createQueryBuilder()
               ->select('r', 'rp')
               ->from('Auth_Model_Role', 'r')
               ->join('r.privileges', 'rp');
               #->groupBy('r.id');
               #->join('rp.Auth_Model_Privilege', 'p');
        $query = $qb->getQuery();
#var_dump($qb->getDql());exit;
        $roles = $query->getResult();

        $this->view->roles = $roles;
    }


}