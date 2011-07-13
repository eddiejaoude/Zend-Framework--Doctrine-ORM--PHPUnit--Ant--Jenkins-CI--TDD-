<?php
/**
 * Custom loggin method
 *
 * @author          Eddie Jaoude
 */
class Custom_Logging {

    /**
     * constructor  method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function  __construct($message, $level) {
        if (APPLICATION_ENV == 'development') {
            $writer = new Zend_Log_Writer_Firebug();
            $logger = new Zend_Log($writer);
            $logger->log($message, $level);
        }
    }

}