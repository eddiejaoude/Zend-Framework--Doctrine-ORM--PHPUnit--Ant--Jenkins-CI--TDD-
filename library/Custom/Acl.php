<?php
class Custom_Acl extends Zend_Acl
{
	public function __construct() {
		$doctrine = Zend_Registry::get('doctrine');
		$model = $doctrine->_em->getRepository('Default_Model_Role');
		/**
		 * Get all the roles from the database and add these to Zend_Acl
		 */
		$roles = $model->findBy(array());
        foreach ($roles as $role)
        {
        	$this->addRole('guest');
        }

        /**
         * Get all resources from the database and add these to Zend_Acl
         */
        $this->addResource(new Zend_Acl_Resource('user.login'));
        $this->addResource(new Zend_Acl_Resource('user.add'));
        $this->addResource(new Zend_Acl_Resource('user.delete'));
        $this->addResource(new Zend_Acl_Resource('user.list'));

        $this->allow(‘guest’, ‘user.login’);
	}
}