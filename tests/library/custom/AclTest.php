<?php
/**
 * Library Custom Acl  Test
 *
 * @author      Koen Huybrechts
 * @package     Application
 *
 */
class LibraryCustomAclTest extends BaseTestCase
{

    /**
     * Object
     *
     * @author 	Koen Huybrechts
     * @param 	object $object
     *
     */
    protected $object;

    /**
     * data
     *
     * @author 	Koen Huybrechts
     * @param 	array $data
     *
     */
    protected $data = array(
        'name' => 'test',
        'email' => 'test@test.com',
        'password' => 'test',
        'role' => 'user',
    	'roleNotLoggedIn' => 'guest',
    	'resourceUser' => 'auth.account.index',
    	'resourceUserNot' => 'auth.no.access',
    	'resourceGuest' => 'default.index.index',
    	'resourceGuestNot' => 'default.no.access',
    );

    /**
     * Initialisation of config object
     *
     * @author 	Koen Huybrechts
     * @param 	null
     * @return 	null
     *
     */
    public function setup() {
        parent::setUp();
        # temporary
        require_once('Custom/Acl.php');
        $this->object = new Custom_Acl;
        $this->model = $this->_em->getRepository('Auth_Model_Account');

        $this->appConfigAuth = new Zend_Config_Ini( APPLICATION_PATH . '/modules/auth/configs/auth.ini', APPLICATION_ENV);
    }

    /**
     * Test object creation
     *
     * @author 	Koen Huybrechts
     * @param 	null
     * @return 	null
     *
     */
    public function testObjectInstance() {
       $this->assertEquals(true, is_object($this->object));
    }
    
    /**
     * Test the role of the user with access
     */
    public function testUserRole()
    {
        $account = $this->model->authenticate($this->appConfigAuth->hash, $this->data);
        $modelRoleMembers = $this->_em->getRepository('Auth_Model_RoleMember');
        $roles = $modelRoleMembers->findBy(array('account_id' => $account->getId()));
        
    	$allowed = false;    	
        foreach ($roles as $role) {
            $modelRoles = $this->_em->getRepository('Auth_Model_Role');
            $roleData = $modelRoles->findOneBy(array('id' => $role->getRole_id()));
            if ($this->object->has($this->data['resourceUser']) && $this->object->isAllowed($roleData->getName(), $this->data['resourceUser'])) {
                $allowed = true;
            }
        }
        $this->assertTrue($allowed);
        $this->assertTrue(is_array($roles));
    }
    
    /**
     * Test the role of the user with no access
     */
    public function testUserNoAccess()
    {
        $account = $this->model->authenticate($this->appConfigAuth->hash, $this->data);
        $modelRoleMembers = $this->_em->getRepository('Auth_Model_RoleMember');
        $roles = $modelRoleMembers->findBy(array('account_id' => $account->getId()));
        
    	$allowed = false;    	
        foreach ($roles as $role) {
            $modelRoles = $this->_em->getRepository('Auth_Model_Role');
            $roleData = $modelRoles->findOneBy(array('id' => $role->getRole_id()));
            if ($this->object->has($this->data['resourceUserNot']) && $this->object->isAllowed($roleData->getName(), $this->data['resourceUserNot'])) {
                $allowed = true;
            }
        }
        $this->assertTrue(!$allowed);
        $this->assertTrue(is_array($roles));
    }
    
    /**
     * Test if user is not logged in
     */
    public function testGuestAccess()
    {
        $allowed = false;
        if ($this->object->has($this->data['resourceGuest']) && $this->object->isAllowed($this->data['roleNotLoggedIn'], $this->data['resourceGuest'])) {
            $allowed = true;
        }
        $this->assertTrue($allowed);
    }
    
    /**
     * Test if user is not logged in
     */
    public function testGuestNoAccess()
    {
        $allowed = false;
        if ($this->object->has($this->data['resourceGuestNot']) && $this->object->isAllowed($this->data['roleNotLoggedIn'], $this->data['resourceGuestNot'])) {
            $allowed = true;
        }
        $this->assertTrue(!$allowed);
    }
    

}