<?php

/**
 * Href helper Test
 *
 * @author        Eddie Jaoude
 * @package     Default
 *
 */

class HrefHelperTest extends BaseTestCase {

    /**
     * Helper object
     *
     * @author 	Eddie Jaoude
     * @param 	object $model
     *
     */
    protected $_helper;

    /**
     * Setup
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function setup() {
        parent::setUp();

        $this->_helper = new Auth_View_Helper_Href;
        $this->assertEquals(true, is_object($this->_helper));
    }

    /**
     * Test href failure method
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testHrefFailure()
    {
        $this->markTestIncomplete('This test has not been implemented yet.' );
        #$result = $this->_helper->href(array());
        #$expected = NULL;
        #$this->assertEquals($expected, $result);
    }

    /**
     * Test href method
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testHrefNoOptions()
    {
        $this->markTestIncomplete('This test has not been implemented yet.' );
        /*$result = $this->_helper->href(array(
            'module' => 'testModule',
            'controller' => 'testController',
            'action' => 'testAction',
            'content' => 'Test Link',
        ));
        $expected = '<a href="'. $result['module'] .' / '. $result['controller'] .'/'. $result['action'] .'">'. $result['content'] .'</a>';
        echo $result . '############';*/
        #$this->assertEquals($expected, $result);
    }

    /**
     * Test href method
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testHrefWithOptions()
    {
        $this->markTestIncomplete('This test has not been implemented yet.' );
        #$expected = '';
        #$result = $this->_helper->href();
        #$this->assertEquals($expected, $result);
    }
    

}