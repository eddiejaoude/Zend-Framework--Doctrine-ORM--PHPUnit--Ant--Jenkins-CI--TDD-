<?php
class Custom_Controller_Plugin_Language
    extends Zend_Controller_Plugin_Abstract
{
	public function routeStartup(Zend_Controller_Request_Abstract $request)
	{
		# Explode the URL in pieces to work with
		$chunks = explode('/',$request->getRequestUri());
		# Check if a language is set
		if(!preg_match('/^\w{2}$/', $chunks[1]) && count($chunks) <= 2) { # If no language is set, something else might be set
			
			# Get the default locale from the registry
		    $locale = Zend_Registry::get('locale');
		    # Set the language like it is set in the configuration (taken from the registry)
		    $request->setParam("lang", $locale->getLanguage());
		    
		    
		    
		    $translate = new Zend_Translate('ini', APPLICATION_PATH . '/modules/default/languages/' . $locale->getLanguage() . '.ini', $locale->getLanguage());
		    Zend_Registry::set('Zend_Translate', $translate);
		    # If no specific page is requested, set the homepage
		    if($chunks[1] == "") {
		    	$request->setParam("slug", "home");
		    } else { # Else set the slug for the requested page
		    	$request->setParam("slug", $chunks[1]);
		    }
		} elseif(preg_match('/^\w{2}$/', $chunks[1])) { # If a language is set, merge all the other parts of the requested URL and put them in the parameter 'slug'
			preg_match('%/?([^/]+)/(.*)%i', $request->getRequestUri(), $matches);
			
			# Get the default locale from the registry
		    $locale = Zend_Registry::get('locale');
		    $locale->setLocale($chunks[1]);
			Zend_Registry::set('locale', $locale);
			
			$translate = new Zend_Translate('ini', APPLICATION_PATH . '/modules/default/languages/' . $locale->getLanguage() . '.ini', $locale->getLanguage());
		    Zend_Registry::set('Zend_Translate', $translate);
		    
			$request->setParam("lang", $chunks[1]);
		    $request->setParam("slug", $matches[2]);
		}
	}
	
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
    	//Zend_Debug::dump($request->getParams()); die;
    }
}
