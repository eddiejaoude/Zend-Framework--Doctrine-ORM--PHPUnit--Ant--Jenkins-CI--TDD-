<?php
/**
 * Layout selenium tests
 *
 * @author        Eddie Jaoude
 * @package     Application
 *
 */
class LayoutSeleniumTest extends BaseSelenium
{

    /**
     * Test title
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
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
