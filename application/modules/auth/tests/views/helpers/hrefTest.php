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
    public function testHrefFailureWithException()
    {
        try {
            $result = $this->_helper->href(array());
        } catch (Exception $e) {
            return;
        }
        $this->fail('No exception thrown');
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
        #$this->markTestIncomplete('This test has not been implemented yet.' );
        $result = $this->_helper->href(array(
        	'module' => 'auth',
        	'controller' => 'login',
        	'action' => 'index',
        	'content' => 'Login'));
#var_dump($result['module']); return;
        #$expected = '<a href="'. $result['module'] .' / '. $result['controller'] .'/'. $result['action'] .'">'. $result['content'] .'</a>';
       
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
        #$expected = '';
        #$result = $this->_helper->href();
        #$this->assertEquals($expected, $result);
    }
    

}