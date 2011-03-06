<?php

require('../application/modules/default/models/userModel.php');
/**
 * Created by JetBrains PhpStorm.
 * User: koko
 * Date: 1/03/11
 * Time: 20:23
 * To change this template use File | Settings | File Templates.
 */

class userModelTest extends BaseTestCase
{
    /**
     * Config object
     *
     * @author     Eddie Jaoude
     * @param     object $config
     *
     */
    protected $config;

    /**
     * Initialisation of config object
     *
     * @author     Eddie Jaoude
     * @param     null
     * @return     null
     *
     */
    public function setup()
    {
        parent::setUp();
        $this->config = new Zend_Config_Ini(APP_PATH . '/configs/application.ini', 'testing');
    }

    public function testFunctionInitExist()
    {
        $userModel = new Default_Model_User();
        $this->assertEquals(true, is_object($userModel));
    }

    /**
     * Finaliase (post-tests)
     *
     * Deletes class variable $this->consignment
     *
     * @author     Eddie Jaoude
     * @param     null
     * @return     null
     *
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->config);
    }
}