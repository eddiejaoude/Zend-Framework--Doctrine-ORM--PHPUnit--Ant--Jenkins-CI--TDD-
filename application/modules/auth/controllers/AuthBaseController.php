<?php

/**
 * Auth Base Controller
 *
 * Base controller to Default Module
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */
abstract class Auth_BaseController extends Application_BaseController
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
