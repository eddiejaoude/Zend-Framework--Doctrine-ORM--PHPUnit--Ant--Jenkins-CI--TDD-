<?php

/**
 * Error Test
 *
 * @author        Eddie Jaoude
 * @package     Default
 *
 */

class ErrorPageTest extends BaseTestCase {

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
    public function testErrorPage()
    { 
        $this->dispatch('/error/error');
        $this->assertModule('default');
        $this->assertController('error');
        $this->assertAction('error');
        
        $this->assertQueryCountMin('div#main h1', 1);
        $this->assertQueryCountMax('div.error', 0);
        $this->assertQueryContentContains('div#main h1', 'An error occurred');
        $this->assertQueryContentContains('div#main h2', 'You have reached the error page');
    }
    
    /**
     * Test homepage
     *
     * @author 	Eddie Jaoude
     * @param 	null
     * @return 	null
     *
     */
    public function testErrorByNonExistingPage()
    { 
        $this->dispatch('/error');
        $this->assertModule('default');
        $this->assertController('error');
        $this->assertAction('error');
        
        $this->assertQueryCountMin('div#main h1', 1);
        $this->assertQueryCountMax('div.error', 0);
        $this->assertQueryContentContains('div#main h1', 'An error occurred');
        $this->assertQueryContentContains('div#main h2', 'Page not found');
        $this->assertQueryCountMax('div#main h3', 0);
    }

}