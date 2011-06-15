<?php

class LayoutSeleniumTest extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://gh.skeleton/'); // change this url to your dev env
    }

    public function testTitle()
    {
        $this->open('/');
        $this->assertTitle('Zend Framework');
        $this->assertTitle('Doctrine2');
        $this->assertTitle('Baseline');
        $this->assertTitle('Skeleton');
    }
}
?>
