<?php

/**
 * Forgot password Test
 *
 * @author        Eddie Jaoude
 * @package     Auth
 *
 */

class ForgotPasswordTest extends BaseTestCase {

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
     * Test form
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testForm()
    {
        $this->dispatch('/auth/password/forgot');
        $this->assertModule('auth');
        $this->assertController('password');
        $this->assertAction('forgot');
        
        $this->assertQueryCountMin('form.box dl.zend_form dd#email-element input#email', 1);
        $this->assertQueryCountMin('html body div#page div#main form.box dl.zend_form dd#sendPassword-element input#sendPassword', 1);
    }
    
    
    /**
     * Test invalid email
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testInvalidEmail()
    {
        $this->request->setMethod('POST')
              ->setPost(array(
                  'email' => 'test'
              ));

        $this->dispatch('/auth/password/forgot');
        $this->assertModule('auth');
        $this->assertController('password');
        $this->assertAction('forgot');
        
        $this->assertQueryCountMin('form.box dl.zend_form dd#email-element ul.errors li', 1);
        $this->assertQueryContentContains('form.box dl.zend_form dd#email-element ul.errors li', 'is no valid email address');
    }
    
    /**
     * Test send password
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testSendPassword()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
        return;
        
        $email = 'test@test.com';
        $this->request->setMethod('POST')
              ->setPost(array(
                  'email' => $email
              ));

        $this->dispatch('/auth/password/forgot');

        $this->assertRedirectTo('/index/index');
        $this->assertModule('default');
        $this->assertController('index');
        $this->assertAction('index');

        $this->assertQueryCountMin('div.error', 1);
        $this->assertQueryContentContains('div.error', 'A new password has been sent to ' . $email);
    }
    
    /**
     * Test unregistered
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testUnregisteredEmail()
    {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
        return;
        
        $email = 'abcdef@test.com';
        $this->request->setMethod('POST')
              ->setPost(array(
                  'email' => $email
              ));

        $this->dispatch('/auth/password/forgot');
        #$this->assertModule('auth');
        $this->assertController('password');
        $this->assertAction('forgot');
        
        $this->assertQueryCountMin('div.error', 1);
        $this->assertQueryContentContains('div.error', 'Sending failed');
    }
    
    /**
     * Test unregistered
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testEmptyEmail()
    {
        $email = '';
        $this->request->setMethod('POST')
              ->setPost(array(
                  'email' => $email
              ));

        $this->dispatch('/auth/password/forgot');
        #$this->assertModule('auth');
        $this->assertController('password');
        $this->assertAction('forgot');
        
        $this->assertQueryCountMin('form.box dl.zend_form dd#email-element ul.errors li', 1);
        $this->assertQueryContentContains('form.box dl.zend_form dd#email-element ul.errors li', 'Value is required and can\'t be empty');
    }

}