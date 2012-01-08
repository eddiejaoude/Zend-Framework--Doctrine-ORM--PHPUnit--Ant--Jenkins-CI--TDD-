<?php
/**
 * Schoolme webservice model
 *
 * @author        Eddie Jaoude
 * @package       Default Module
 *
 */
class Default_Model_Schoolme extends Default_Model_Base {
    
    /**
     * Webservice client
     *
     * @author          Eddie Jaoude
     * @param           object $_client
     *
     */
    private $_client = null;
    
    /**
     * Constructor
     * 
     * Pass in webservice url
     *
     * @author          Eddie Jaoude
     * @param           string $url
     * @return           void
     *
     */
    public function __construct($url) {
        $this->_client = new Zend_Rest_Client($url);
    }

    /**
     * Search
     * 
     * search conditions
     *
     * @author          Eddie Jaoude
     * @param           array $conditions
     * @return          object
     *
     */
    public function search($conditions) {
        
        $this->_client->search();
        foreach ($conditions as $k=>$v) {
            $this->_client->$k($v);
        }
        return $this->_client->get()->schools;
    }
    
    
}