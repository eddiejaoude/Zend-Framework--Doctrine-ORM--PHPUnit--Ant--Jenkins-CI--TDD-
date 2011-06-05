<?php
class Application_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{

    /**
     * Pre dispatch
     *
     * @author          Koen Huybrechts
     * @param           Zend_Controller_Request_Abstract $request
     * @return          void
     *
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
    	$mac = $request->getModuleName() . '.' . $request->getControllerName() . '.' . $request->getActionName();
    	$resource = strtolower($mac);
    	
        $acl = new Custom_Acl();
        $doctrine = Zend_Registry::get('doctrine');
        
	    if (Zend_Auth::getInstance()->hasIdentity()) {
	    	$accountId = Zend_Auth::getInstance()->getIdentity()
		                                      ->getId();
		    	
			$modelRoleMembers = $doctrine->_em->getRepository('Auth_Model_RoleMember');
			$roles = $modelRoleMembers->findBy(array('account_id' => $accountId));
			
			$allowed = false;
			foreach ($roles as $role)
			{
				$modelRoles = $doctrine->_em->getRepository('Auth_Model_Role');
				$roleData = $modelRoles->findOneBy(array('id' => $role->getRole_id()));
				if($acl->has($resource) && $acl->isAllowed($roleData->getName(), $resource)) {
					$allowed = true;
				}
				
			}
		} else {
			$allowed = false;
			$modelRoles = $doctrine->_em->getRepository('Auth_Model_Role');
			if($acl->has($resource) && $acl->isAllowed('guest', $resource)) {
				$allowed = true;
			}
			
		}
			
		if(!$allowed) {
			$request->setModuleName('auth');
			$request->setControllerName('index');
			$request->setActionName('denied');
		}
    }
}