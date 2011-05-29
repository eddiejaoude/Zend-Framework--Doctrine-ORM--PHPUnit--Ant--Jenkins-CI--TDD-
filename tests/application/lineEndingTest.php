<?php
/**
 * Application line ending testing
 *
 * @author        Eddie Jaoude
 * @package     Application
 *
 */
class LineEndingTest extends BaseTestCase
{
    /**
     * Relative directory
     *
     * @author 	Eddie Jaoude
     * @param 	string $directory
     *
     */
    protected $directory = '/..';

    /**
     * Ignore directories
     *
     * @author 	Eddie Jaoude
     * @param 	array $ignore
     *
     */
    #protected $ignore = array('.git/', 'docs/', '.bat', '.png', '.wsdl', '.xsd', '.sql');

    /**
     * Full path
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function setup() {
        parent::setUp();

        $this->directory = APPLICATION_PATH . $this->directory;
    }

   /**
     * Test line endings 
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
   public function testApplicationDirectory() {
        $list = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->directory));
        foreach ($list as $k=> $v) {
            if (!stristr($v, '.git/') && !stristr($v, 'docs/') && !stristr($v, '.bat')  && !stristr($v, '.png') && !stristr($v, '.wsdl') && !stristr($v, '.xsd') && !stristr($v, '.sql')) {
                try {
                    $this->assertEquals(false, stristr(file_get_contents($v), "\r\n"));
                } catch (Exception $e) {
                    $this->fail('Conflicting file found: ' . $v);
                }
            }
        }

    }

    /**
     * Finaliase (post-tests)
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function tearDown() {
        parent::tearDown();
    }

}