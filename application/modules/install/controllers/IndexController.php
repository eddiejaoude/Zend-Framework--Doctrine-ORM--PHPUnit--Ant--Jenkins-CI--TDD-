<?php
/**
 * Auth Default Controller
 *
 *
 * @author          Koen Huybrechts
 * @package       Auth Module
 *
 */
class Install_IndexController extends Install_BaseController
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

    /**
     * default method
     *
     * @author          Koen Huybrechts
     * @param           void
     * @return           void
     *
     */
    public function indexAction()
    {
        $this->_forward('checks', 'setup', 'install');
    }

    /**
     * access denied method
     *
     * @author          Koen Huybrechts
     * @param           void
     * @return           void
     *
     */
    public function deniedAction()
    {
        
    }


}

