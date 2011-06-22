<?php
/**
 * Selenium base class
 *
 * @author        Eddie Jaoude
 * @package     Application
 *
 */
class BaseSelenium extends PHPUnit_Extensions_SeleniumTestCase
{

    /**
     * Setup tests
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://build.jaoudestudios.com/'); // change this url to your dev env
    }


}
?>
