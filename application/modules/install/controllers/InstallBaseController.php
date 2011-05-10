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
