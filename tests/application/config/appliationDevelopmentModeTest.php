<?php
/**
 * Application Config Dev Mode Test
 * 
 * @author        Eddie Jaoude
 * @package     Application
 * 
 */
class ApplicationConfigDevModeTest extends BaseTestCase
{
    /**
     * Config object
     * 
     * @author 	Eddie Jaoude
     * @param 	object $config
     * 
     */
    protected $config;

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
        $this->config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'development');
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
       $this->assertEquals(true, is_object($this->config));
    }

    /**
     * Test default layout
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testDefaultLayout() {
        $this->assertEquals('master', $this->config->resources->layout->layout);
    }

    /**
     * Test PHP error modes
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testErrorModes() {
        $this->assertEquals(1, $this->config->phpSettings->display_startup_errors);
        $this->assertEquals(1, $this->config->phpSettings->display_errors);
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