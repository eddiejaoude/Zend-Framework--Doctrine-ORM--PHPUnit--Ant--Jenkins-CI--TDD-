<?php
/**
 * Install check plugin
 *
 * @author        Koen Huybrechts
 * @package       Install Module
 *
 */
class Application_Plugin_InstallCheck extends Zend_Controller_Plugin_Abstract
{

    /**
     * Route startup
     *
     * @author          Koen Huybrechts
     * @param           Zend_Controller_Request_Abstract $request
     * @return           void
     *
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
    	
    	# Get the configuration of the install module
        $installConfig = new Zend_Config_Ini( APPLICATION_PATH . 
                DIRECTORY_SEPARATOR . 'modules' . 
                DIRECTORY_SEPARATOR . 'install' . 
                DIRECTORY_SEPARATOR . 'configs' .
                DIRECTORY_SEPARATOR . 'install.ini', APPLICATION_ENV);
                
        # Get the request object
      	$request = $this->getRequest();
      	
      	#Only run this forward if the application isn't installed yet and when we aren't in this module yet
      	//Zend_Debug::dump($request->getModuleName());
        if(!$installConfig->installed && $request->getModuleName() != 'install') {
        	//$redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('redirector');
			//$redirector->gotoUrl('/install');
        }
    }


}