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
        'role' => 'user'
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
     * Test the role of the user
     */
    public function testUserRole()
    {
        $result = $this->model->authenticate($this->appConfigAuth->hash, $this->data);
    	$this->assertEquals($this->data['role'], $result->getRole());
    }
    

}