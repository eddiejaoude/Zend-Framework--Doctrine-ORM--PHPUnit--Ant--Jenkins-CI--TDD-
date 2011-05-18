<?php

/**
 * Install Base Controller
 *
 * Base controller to Install Module
 *
 * @author        Koen Huybrechts
 * @package       Install Module
 *
 */
abstract class Install_BaseController extends Application_BaseController
{

    /**
     * Initialisation method
     *
     * @author          Koen Huybrechts
     * @param           void
     * @return           void
     *
     */
    public function init()
    {
        parent::init();
        
        # do not allow access to module if in production mode 
        # or install wizard has already been completed
        if (true == $this->_registry->config->install->installed || APPLICATION_ENV !== 'development')
        {
            $this->_helper->redirector('index', 'index', 'default');
        }
    }

    /**
     * post dispatch method
     *
     * @author          Koen Huybrechts
     * @param           void
     * @return           void
     *
     */
    public function  postDispatch()
    {
        parent::postDispatch();
    }

}
?>
