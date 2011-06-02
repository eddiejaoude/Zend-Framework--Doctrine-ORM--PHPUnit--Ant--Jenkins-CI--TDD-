<?php
class Custom_Plugins_Acl extends Zend_Controller_Plugin_Abstract
{

    /**
     * Pre dispatch
     *
     * @author          Koen Huybrechts
     * @param           Zend_Controller_Request_Abstract $request
     * @return          void
     *
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $acl = new Custom_Acl();
    }
}