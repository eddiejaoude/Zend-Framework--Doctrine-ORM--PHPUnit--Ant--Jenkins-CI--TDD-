<?php

/**
 * Account Test
 * 
 * @author        Eddie Jaoude
 * @package     Auth
 * 
 */
class Auth_AccountModelTest extends BaseTestCase {

    /**
     * Model object
     * 
     * @author 	Eddie Jaoude
     * @param 	object $model
     * 
     */
    protected $model;

    /**
     * data
     *
     * @author 	Eddie Jaoude
     * @param 	array $data
     *
     */
    protected $data = array(
        'name' => 'test',
        'email' => 'test@test.com',
        'password' => 'test'
    );

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
     * Test save password no hash exception
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testSavePasswordNoHashException() {
        # save info
        $account = new Auth_Model_Account;
        try {
            $account->setPassword($this->data['email'], '');
        } catch (Exception $expected) {
            return;
        }
        $this->fail('An expected exception has not been raised.');
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
        # save info
        $account = new Auth_Model_Account;
        $account->setName($this->data['name']);
        $account->setEmail($this->data['email']);
        $account->setPassword($this->data['password'], $this->appConfig->auth->hash);
        $date = new Zend_Date;
        $now = $date->toString('YYYY-MM-dd HH:mm:ss');
        $account->setCreated_at($now);
        $this->_em->persist($account);
        $this->_em->flush();

        # retrieve save info & clarify it is correct
        $accountDetails = $this->_em->find('Auth_Model_Account' , $account->getId());
        $this->assertEquals($this->data['name'], $accountDetails->getName());
        $this->assertEquals($this->data['email'], $accountDetails->getEmail());
        $this->assertNotEquals($this->data['password'], $accountDetails->getPassword());
        $this->assertEquals($now, $accountDetails->getCreated_at());
    }

    /**
     * Test authenticate
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testAuthenticate() {
        $result = $this->model->authenticate($this->appConfig->auth->hash, $this->data);

        $this->assertEquals($this->data['name'], $result->getName());
        $this->assertEquals($this->data['email'], $result->getEmail());
        $this->assertNotEquals($this->data['password'], $result->getPassword());
    }

    /**
     * Test authenticate no hash exception
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testAuthenticateNoHashException() {
        try {
            $result = $this->model->authenticate('', $this->data);
        } catch (Exception $expected) {
            return;
        }
        $this->fail('An expected exception has not been raised.');
    }

    /**
     * Test authenticate no data exception
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testAuthenticateNoDataException() {
        try {
            $this->model->authenticate($this->appConfig->auth->hash, '');
        } catch (Exception $expected) {
            return;
        }
        $this->fail('An expected exception has not been raised.');
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
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

}