<?php

/**
 * Static Base Controller
 *
 * Base controller to Static Module
 *
 * @author        Koen Huybrechts
 * @package       Default Module
 *
 */
abstract class BaseController extends Application_BaseController
{

    /**
     * Initialisation method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function init()
    {
        parent::init();
    }

    /**
     * post dispatch method
     *
     * @author          Eddie Jaoude
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
