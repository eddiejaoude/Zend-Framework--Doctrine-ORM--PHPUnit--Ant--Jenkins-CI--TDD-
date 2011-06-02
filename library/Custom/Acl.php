<?php
class Custom_Acl extends Zend_Acl
{
	public function __construct() {
		$doctrine = Zend_Registry::get('doctrine');
		/**
		 * Get all the roles from the database and add these to Zend_Acl
		 */
		$modelRoles = $doctrine->_em->getRepository('Default_Model_Role');
		$roles = $modelRoles->findBy(array());
		
        foreach ($roles as $role)
        {
        	$this->addRole($role->getName());
        }
        
        /**
         * Get all resources from the database and add these to Zend_Acl
         */
        $modelPrivileges = $doctrine->_em->getRepository('Default_Model_Privilege');
        $privileges = $modelPrivileges->findBy(array());
        
        foreach ($privileges as $privilege)
        {
        	$data['module'] = $privilege->getModule();
        	$data['controller'] = $privilege->getController();
        	$data['action'] = $privilege->getAction();
        	
        	$this->addResource(new Zend_Acl_Resource(implode('.', $data)));
        }

        //$this->allow(‘guest’, ‘user.login’);
	}
}