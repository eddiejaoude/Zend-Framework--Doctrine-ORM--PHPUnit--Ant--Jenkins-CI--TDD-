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

    public function testForm()
    {
        $this->dispatch('/auth/login');
        #$this->assertModule('auth');
        $this->assertController('login');
        $this->assertAction('index');
    }

}