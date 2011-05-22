<?php

/**
 * History Test
 *
 * @author        Eddie Jaoude
 * @package     Auth
 *
 */

class HistoryViewTest extends BaseTestCase {

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
     * Test event list is displayed
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testEventList()
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

        $this->assertRedirectTo('/auth/account');

        # events page
        $this->dispatch('/auth/account/event');
        $this->assertModule('auth');
        $this->assertController('account');
        $this->assertAction('event');

        $this->resetRequest()
             ->resetResponse();
        $this->request->setPost(array());
        $this->request->setMethod('GET');

        $this->dispatch('/auth/account/event');

        $this->assertQueryCountMin('table.data', 1);
        $this->assertQueryCountMin('table.data tbody tr', 1);
        
        $this->mainNavigationCheck();
    }

}