<?php

/**
 * Role Model Test
 *
 * @author        Eddie Jaoude
 * @package     Auth
 *
 */
class Auth_RoleModelTest extends BaseTestCase {

    /**
     * Model object
     *
     * @author 	Eddie Jaoude
     * @param 	object $model
     *
     */
    protected $model;

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
        $this->assertEquals(true, is_object($this->_em));
        $this->model = $this->_em->getRepository('Auth_Model_Role');

        $this->appConfigAuth = new Zend_Config_Ini( APPLICATION_PATH . '/modules/auth/configs/auth.ini', APPLICATION_ENV);
    }

    /**
     * Test object creation
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testObjectInstance() {
        $this->assertEquals(true, is_object($this->model));
    }

}