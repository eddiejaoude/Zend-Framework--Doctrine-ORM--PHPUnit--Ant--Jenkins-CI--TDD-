<?php

/**
 * Table helper Test
 *
 * @author        Eddie Jaoude
 * @package     Default
 *
 */

class TableHelperTest extends BaseTestCase {

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

        $this->_helper = new Default_View_Helper_Table;
        $this->assertEquals(true, is_object($this->_helper));
    }

    /**
     * Test table method
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testTableMethodBasic()
    {
        $expected = '<table><thead><tr><td>a</td><td>b</td></tr></thead><body>';
        $result = $this->_helper->table(array(array('value' => 'a'), array('value' => 'b')));
        $this->assertEquals($expected, $result);
    }

    /**
     * Test table method
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testTableMethodFull()
    {
        $expected = '<table id="id_a" class="class_a"><thead><tr><td>100</td><td>200</td></tr></thead><body>';
        $result = $this->_helper->table(array(array('value' => '100'), array('value' => '200')), array('id' => 'id_a', 'class' => 'class_a'));
        $this->assertEquals($expected, $result);
    }

    /**
     * Test multiple tables
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testMultipleTables()
    {
        $expected = '<table id="id_a" class="class_a"><thead><tr><td>100</td><td>200</td></tr></thead><body>';
        $result = $this->_helper->table(array(array('value' => '100'), array('value' => '200')), array('id' => 'id_a', 'class' => 'class_a'));
        $result .= $this->_helper->table(array(array('value' => '100'), array('value' => '200')), array('id' => 'id_a', 'class' => 'class_a'));
        $this->assertEquals($expected . $expected, $result);
    }

    /**
     * Test attribute method
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testAttributeMethod()
    {
        $expected = ' abc="123"';
        $result = $this->_helper->attribute('abc', '123');
        $this->assertEquals($expected, $result);
    }

    /**
     * Test add row method
     *
     * Including adding multiple row calls
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testAddRowMethod()
    {
        $expected = '<tr><td id="id_a" class="class_a">100</td></tr><tr><td id="id_b" class="class_b">200</td></tr>';
        $rows = array(
            array(
                'id' => 'id_a',
                'class' => 'class_a',
                'value' => '100',
            ),
            array(
                'id' => 'id_b',
                'class' => 'class_b',
                'value' => '200',
            )
        );
        $result = $this->_helper->addRow($rows);
        $this->assertEquals($expected, $result);

        # add another row
        $rows = array(
            array(
                'id' => 'id_c',
                'class' => 'class_c',
                'value' => '300',
            ),
            array(
                'id' => 'id_d',
                'class' => 'class_d',
                'value' => '400',
            )
        );
        $result = $this->_helper->addRow($rows);
        $expected2 = '<tr><td id="id_c" class="class_c">300</td></tr><tr><td id="id_d" class="class_d">400</td></tr>';
        $this->assertEquals($expected . $expected2, $result);
    }

    /**
     * Test end table method
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testEndTableMethod()
    {
        $expected = '</body></table>';
        $result = $this->_helper->endTable();
        $this->assertEquals($expected, $result);
    }

}