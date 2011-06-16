<?php

class Custom_Acl extends Zend_Acl {

    public function __construct() {
        $doctrine = Zend_Registry::get('doctrine');
        /**
         * Get all the roles from the database and add these to Zend_Acl
         */
        $modelRoles = $doctrine->_em->getRepository('Auth_Model_Role');
        $roles = $modelRoles->findBy(array());

        foreach ($roles as $role) {
            $this->addRole($role->getName());
        }

        /**
         * Get all resources from the database and add these to Zend_Acl
         */
        $modelPrivileges = $doctrine->_em->getRepository('Auth_Model_Privilege');
        $privileges = $modelPrivileges->findBy(array());

        foreach ($privileges as $privilege) {
            # Prepare to add as a resource
            $data['module'] = $privilege->getModule();
            $data['controller'] = $privilege->getController();
            $data['action'] = $privilege->getAction();

            $this->addResource(new Zend_Acl_Resource(implode('.', $data)));
        }

        /**
         * Really make the connection between role and privilege
         */
        $modelRolePrivileges = $doctrine->_em->getRepository('Auth_Model_RolePrivilege');
        $rolePrivileges = $modelRolePrivileges->findBy(array());

        foreach ($rolePrivileges as $rolePrivilege) {
            $roleId = $rolePrivilege->getRole_Id();
            $privilegeId = $rolePrivilege->getPrivilege_Id();

            $role = $modelRoles->findOneBy(array('id' => $roleId));
            $privilege = $modelPrivileges->findOneBy(array('id' => $privilegeId));

            # Prepare to add as a resource
            $data['module'] = $privilege->getModule();
            $data['controller'] = $privilege->getController();
            $data['action'] = $privilege->getAction();

            $this->allow($role->getName(), implode('.', $data));
        }
    }

}