<?php

class BaseSelenium extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://build.jaoudestudios.com/'); // change this url to your dev env
    }


}
?>
