<?php

/**
 * Logout Test
 *
 * @author        Eddie Jaoude
 * @package     Auth
 *
 */

class LogoutViewTest extends BaseTestCase {

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
     * Test logout
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testLogout()
    {
        # login
        $this->request->setMethod('POST')
              ->setPost(array(
                  'email' => 'test@test.com',
                  'password' => 'test'
              ));

        $this->dispatch('/auth/login');
        $this->assertRedirectTo('/auth/account');

        # logout
        $this->dispatch('/auth/logout');
        $this->assertModule('auth');
        $this->assertController('logout');
        $this->assertAction('index');

        $this->assertRedirectTo('/auth/login');

    }


}