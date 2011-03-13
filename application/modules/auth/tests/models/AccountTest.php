<?php
/**
 * Account Test
 * 
 * @author        Eddie Jaoude
 * @package     Auth
 * 
 */
require( APP_PATH . '/modules/auth/models/Account.php');
class AccountModelTest extends BaseTestCase
{
    /**
     * Model object
     * 
     * @author 	Eddie Jaoude
     * @param 	object $model
     * 
     */
    protected $model;

    /**
     * Initialisation of config object
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function setup() {
        parent::setUp();
        $this->assertEquals(true, is_object($this->_em));
        $this->model = $this->_em->getRepository('Auth_Model_Account');
    }

    /**
     * Test object creation
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testObjectInstance() {
       $this->assertEquals(true, is_object($this->model));
    }
    
}