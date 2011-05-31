<?php
/**
 *
 * @author koenhuybrechts
 * @version 
 */

/**
 * TemplateSelector Action Helper 
 * 
 * @uses actionHelper Custom_Controller_Helper
 */
class Zend_Controller_Action_Helper_TemplateSelector extends Zend_Controller_Action_Helper_Abstract
{
    /**
     * @var Zend_Loader_PluginLoader
     */
    public $pluginLoader;
    /**
     * Constructor: initialize plugin loader
     * 
     * @return void
     */
    public function __construct ()
    {
        // TODO Auto-generated Constructor
        $this->pluginLoader = new Zend_Loader_PluginLoader();
    }
    /**
     * Strategy pattern: call helper as broker method
     */
    public function direct ()
    {
    	if(Zend_Controller_Front::getInstance()->getRouter()->getCurrentRouteName() == 'admin') {
    		$template = 'admin';
    	} else {
    		$userAgent = new Zend_Http_UserAgent();
    		$userAgent->getDevice();
    		switch ($userAgent->getBrowserType()) {
    			case 'Mobile': 
	                $template = 'mobile';
	                break;
	            default: 
	                $template = 'frontend';
	                break; 
    		}
    	}
    	return $template;        
    }
}
