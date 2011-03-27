<?php

/**
 * Login Test
 *
 * @author        Eddie Jaoude
 * @package     Auth
 *
 */

class LoginViewTest extends BaseTestCase {

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

    /**
     * Test form exists on login page
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testForm()
    {
        $this->dispatch('/auth/login');
        $this->assertModule('auth');
        $this->assertController('login');
        $this->assertAction('index');
        
        $this->assertQueryCount('form#Login', 1);
        $this->assertQueryCount('input#email', 1);
        $this->assertQueryCount('input#password', 1);

        $this->assertQueryCount('div.error', 0);
    }

    /**
     * Test login failure incorrect credentials
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testLoginFailureIncorrectCredentials()
    {
        $this->request->setMethod('POST')
              ->setPost(array(
                  'email' => 'test@test.com',
                  'password' => 'foobar'
              ));

        $this->dispatch('/auth/login');
        $this->assertModule('auth');
        $this->assertController('login');
        $this->assertAction('index');

        $this->assertQueryCount('form#Login', 1);
        $this->assertQueryCount('input#email', 1);
        $this->assertQueryCount('input#password', 1);

        $this->assertQueryCount('div.error', 1);
    }

    /**
     * Test login failure validation error
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testLoginFailureValidationError()
    {
        $this->request->setMethod('POST')
              ->setPost(array(
                  'email' => 'test@test',
                  'password' => ''
              ));

        $this->dispatch('/auth/login');
        $this->assertModule('auth');
        $this->assertController('login');
        $this->assertAction('index');

        $this->assertQueryCount('form#Login', 1);
        $this->assertQueryCount('input#email', 1);
        $this->assertQueryCount('input#password', 1);

        $this->assertQueryCount('dd#email-element ul.errors', 1);
        $this->assertQueryCount('dd#password-element ul.errors', 1);
    }

    /**
     * Test login successful
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testLoginSuccessful()
    {
        $this->request->setMethod('POST')
              ->setPost(array(
                  'email' => 'test@test.com',
                  'password' => 'test'
              ));

        $this->dispatch('/auth/login');
        $this->assertModule('auth');
        $this->assertController('login');
        $this->assertAction('index');
        
        $this->assertRedirectTo('/auth');
    }

}