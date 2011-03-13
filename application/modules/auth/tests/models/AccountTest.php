<?php

/**
 * Account Test
 * 
 * @author        Eddie Jaoude
 * @package     Auth
 * 
 */
require( APP_PATH . '/modules/auth/models/Account.php');

class AccountModelTest extends BaseTestCase {

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
    
    /**
     * Test save
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testSaveAndRetrieve() {
        # info
        $name = 'test';
        $email = 'test@test.com';
        $password = 'test';
        
        # save info
        $account = new Auth_Model_Account;
        $account->setName($name);
        $account->setEmail($email);
        $account->setPassword($email);
        $date = new Zend_Date;
        $now = $date->toString('YYYY-MM-dd HH:mm:ss');
        $account->setCreated_at($now);
        $this->_em->persist($account);
        $this->_em->flush();

        # retrieve save info & clarify it is correct
        $accountDetails = $this->_em->find('Auth_Model_Account' , $account->getId());
        $this->assertEquals($name, $accountDetails->getName());
        $this->assertEquals($email, $accountDetails->getEmail());
        $this->assertNotEquals($password, $accountDetails->getPassword());
        $this->assertEquals($now, $accountDetails->getCreated_at());
    }
    
     /**
     * Test delete
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testDelete() {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

}