<?php

/**
 * Forgot password Test
 *
 * @author        Eddie Jaoude
 * @package     Auth
 *
 */

class ForgotPasswordTest extends BaseTestCase
{

    /**
     * Initialisation of config object
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function setup()
    {
        parent::setUp();
    }

    public function testNavigation()
    {
        $this->dispatch('/auth/password/forgot');
        $this->mainNavigationCheck();
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
    /*    public function testSendPassword()
    {

    }*/

    /**
     * Test unregistered
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    /*    public function testUnregisteredEmail()
    {

    }*/

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