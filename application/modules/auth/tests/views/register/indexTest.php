<?php

/**
 * Register Test
 *
 * @author        Eddie Jaoude
 * @package     Auth
 *
 */

class Auth_Register_IndexViewTest extends BaseTestCase {

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
    }

    public function testForm()
    {
        $this->dispatch('/auth/register');
        $this->assertModule('auth');
        $this->assertController('register');
        $this->assertAction('index');
        $this->assertQueryCount('form#Register', 1);
    }

    public function testRequiredFieldMessages()
    {
        $this->request->setMethod('POST')
              ->setPost(array( ));

        $this->dispatch('/auth/register');
        $this->assertModule('auth');
        $this->assertController('register');
        $this->assertAction('index');

        $this->assertQueryCount('ul.errors', 4);
    }

    public function testSuccessfulRegistration()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        /*
        $this->request->setMethod('POST')
              ->setPost(array(
                  'name' => 'test',
                  'email' => 'test@email.com',
                  'password' => 'test',
              ));

        $this->dispatch('/auth/register');
        $this->assertModule('auth');
        $this->assertController('register');
        $this->assertAction('index');
        */
    }

}