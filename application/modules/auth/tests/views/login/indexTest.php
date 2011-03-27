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
    }

    /**
     * Test login failure
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testLoginFailure()
    {

    }

    /**
     * Test login successful
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testLoginSuccessfull()
    {

    }

}