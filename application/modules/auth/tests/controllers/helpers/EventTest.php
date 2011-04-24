<?php

/**
 * Event Test
 *
 * @author        Eddie Jaoude
 * @package     Auth
 *
 */
class Auth_EventControllerActionHelperTest extends BaseTestCase {

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
        $this->model = $this->_em->getRepository('Auth_Model_AccountEvent');
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

    /**
     * Test save password no hash exception
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testRecord() {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

}