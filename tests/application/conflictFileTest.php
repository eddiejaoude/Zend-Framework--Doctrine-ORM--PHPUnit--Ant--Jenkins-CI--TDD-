<?php
/**
 * Application Config Dev Mode Test
 * 
 * @author        Eddie Jaoude
 * @package     Application
 * 
 */
class ConflictFileTest extends BaseTestCase
{
    /**
     * Config object
     * 
     * @author 	Eddie Jaoude
     * @param 	object $config
     * 
     */
    protected $directory = '';
    
    /**
     * Initialisation of config object
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

   public function testApplicationDirectory() {
        $list = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->directory));
        foreach ($list as $k=> $v) {
                try {
                    $this->assertEquals(false, stristr($v, '.LOCAL.'));
                    $this->assertEquals(false, stristr($v, '.REMOTE.'));
                    $this->assertEquals(false, stristr($v, '.BASE.'));
                } catch (Exception $e) {
                    $this->fail('Conflicting file found: ' . $v);
                }
                
        }
        
    }
    
    /**
     * Finaliase (post-tests)
     *
     * Deletes class variable $this->consignment
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