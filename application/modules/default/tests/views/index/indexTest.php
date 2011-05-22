<?php

/**
 * Homepage Test
 *
 * @author        Eddie Jaoude
 * @package     Default
 *
 */

class HomePageTest extends BaseTestCase {

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
    }

    /**
     * Test homepage
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testHomepage()
    { 
        $this->dispatch('/');
        $this->assertModule('default');
        $this->assertController('index');
        $this->assertAction('index');
        
        $this->assertQueryCountMin('div#main p', 1);
        $this->assertQueryCountMax('div#error', 0);
    }

}