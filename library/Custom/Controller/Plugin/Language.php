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
		    
		    # If no specific page is requested, set the homepage
		    if($chunks[1] == "") {
		    	$request->setParam("slug", "home");
		    } else { # Else set the slug for the requested page
		    	$request->setParam("slug", $chunks[1]);
		    }
		} else { # If a language is set, merge all the other parts of the requested URL and put them in the parameter 'slug'
			preg_match('%/?([^/]+)/(.*)%i', $request->getRequestUri(), $matches);
			$request->setParam("lang", $chunks[1]);
		    $request->setParam("slug", $matches[2]);
		}
	}
	
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        $lang = $request->getParam('lang', null);

        $translate = Zend_Registry::get('translate');

        // Change language if available
        if ($translate->isAvailable($lang)) {
            $translate->setLocale($lang);
        } else {
            // Otherwise get default language
            $locale = $translate->getLocale();
            if ($locale instanceof Zend_Locale) {
                $lang = $locale->getLanguage();
            } else {
                $lang = $locale;
            }
        }

        // Set language to global param so that our language route can
        // fetch it nicely.
        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();
        $router->setGlobalParam('lang', $lang);
    }
}
