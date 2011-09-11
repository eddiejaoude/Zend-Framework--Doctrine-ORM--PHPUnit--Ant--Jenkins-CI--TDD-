<?php
/**
 * Library Custom Auth Validate  Test
 *
 * @author        Eddie Jaoude
 * @package     Application
 *
 */
class LibraryCustomAuthValidateTest extends BaseTestCase
{

    /**
     * Object
     *
     * @author 	Eddie Jaoude
     * @param 	object $object
     *
     */
    protected $object;

    /**
     * Initialisation of config object
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function setup() {
        # temporary
        require_once('Custom/Auth/Validate/NotIdentical.php');

        $this->object = new Custom_Auth_Validate_NotIdentical;
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
       $this->assertEquals(true, is_object($this->object));
    }

    /**
     * Test Not Identical method
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testNotIdentical() {
       $this->markTestIncomplete('This test has not been implemented yet.');
    }

}
