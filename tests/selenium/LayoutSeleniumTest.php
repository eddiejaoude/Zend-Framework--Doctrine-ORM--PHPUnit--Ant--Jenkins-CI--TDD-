<?php

class LayoutSeleniumTest extends BaseSelenium
{
    
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
