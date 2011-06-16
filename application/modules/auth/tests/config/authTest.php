<?php
/**
 * Application Config Dev Mode Test
 * 
 * @author      Koen Huybrechts
 * @package     Application
 * 
 */
class AuthTest extends BaseTestCase
{
    /**
     * Config object
     * 
     * @author 	Koen Huybrechts
     * @param 	object $config
     * 
     */
    protected $config;

    /**
     * Initialisation of config object
     *
     * @author 	Koen Huybrechts
     * @param 	null
     * @return 	null
     *
     */
    public function setup() {
        parent::setUp();
        $this->config = new Zend_Config_Ini(APPLICATION_PATH . '/modules/auth/configs/auth.ini', 'production');
    }

    /**
     * Test object creation
     *
     * @author 	Koen Huybrechts
     * @param 	null
     * @return 	null
     *
     */
    public function testObjectInstance() {
       $this->assertEquals(true, is_object($this->config));
    }

    /**
     * Test password hash is set
     *
     * @author 	Koen Huybrechts
     * @param 	null
     * @return 	null
     *
     */
    public function testPasswordHashIsSet() {
        $this->assertTrue(isset($this->config->hash));
    }

    /**
     * Test password hash value
     *
     * @author 	Koen Huybrechts
     * @param 	null
     * @return 	null
     *
     */
    public function testPasswordHashValue() {
        $this->assertTrue(ctype_alnum($this->config->hash));
    }

    /**
     * Test password length isset
     *
     * @author 	Koen Huybrechts
     * @param 	null
     * @return 	null
     *
     */
    public function testPasswordLengthIsSet() {
        $this->assertTrue(isset($this->config->password->length));
    }

    /**
     * Test password length value integer
     *
     * @author 	Koen Huybrechts
     * @param 	null
     * @return 	null
     *
     */
    public function testPasswordLengthValueInteger() {
        $this->assertTrue((int) $this->config->password->length == $this->config->password->length && (int)$this->config->password->length > 0);
    }

    /**
     * Test password length value is positive
     *
     * @author 	Koen Huybrechts
     * @param 	null
     * @return 	null
     *
     */
    public function testPasswordLengthValuePositive() {
        $this->assertTrue((int)$this->config->password->length > 0);
    }

    /**
     * Finaliase (post-tests)
     *
     * Deletes class variable $this->consignment
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function tearDown() {
        parent::tearDown();
        unset($this->config);
    }

}