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

    public function testRequiredFields()
    {
        $this->dispatch('/auth/register');
        $this->assertModule('auth');
        $this->assertController('register');
        $this->assertAction('index');
        
    }

}