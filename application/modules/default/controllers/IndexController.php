<?php
/**
 * Default Base Controller
 *
 * Base controller to Default Module
 *
 * @author          Eddie Jaoude
 * @package       Default Module
 *
 */
class IndexController extends BaseController
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
        
    }

    /**
     * default method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function indexAction() {
        # get registery
        $registry = Zend_Registry::getInstance();
        $_em = $registry->doctrine->_em;
        
        $account = $_em->find('Default_Model_Account', 3);
        echo $account->getName();
    }
    


}

