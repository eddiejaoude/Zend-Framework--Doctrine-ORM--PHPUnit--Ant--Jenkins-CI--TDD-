<?php

/**
 * Custom URL helper
 * This helper does an ACL-check on the URL to render
 */
class Auth_View_Helper_Href extends Zend_View_Helper_Url {

    private $options = array(
        'module' => 'default', //default module
        'controller' => null, //default controller
        'action' => 'index', //default action
        'params' => array(), //array of parameters
        'content' => null, //Link content, text or what you want between <a> and </a>
        'attributes' => array(), //Link attributes, e.g. class or id
        'resource' => null, //ACL resource name, if not set - controller name will be used
        'reset' => false, //reset router defaults
        'url' => null, //Url like "http://google.com", will be used if controller is null
        'role' => null,
        'getvariables' => array()
    );

    /**
     * @param array $options
     * @return string or bool FALSE if options are incorrect or access denied
     */
    public function href(array $options, $name = 'default', $reset = false, $encode = NULL) {
        if (!empty($options['attributes'])) {
            $attributes = '';
            foreach ($options['attributes'] as $key => $value) {
                $attributes .= $key . "='" . $value . "' ";
            }
        } else {
            $attributes = null;
        }
        if ($this->checkAcl($options)) {

            $urlOptions = array();
            $urlOptions['module'] = $options['module'];
            $urlOptions['controller'] = $options['controller'];
            $urlOptions['action'] = $options['action'];
            if (isset($options['getvariables']) && count($options['getvariables']) > 0) {
                foreach ($options['getvariables'] as $key => $value) {
                    $urlOptions[$key] = $value;
                }
            }
            $router = Zend_Controller_Front::getInstance()->getRouter();
            $url = $router->assemble($urlOptions, $name, $reset, $encode);

            $return = "<a href='" . $url . "' " . $attributes . ">" . $options['content'] . "</a>";
        } else {
            $return = NULL;
        }
        return $return;
    }

    public function checkAcl($options) {
        $mac = $options['module'] . '.' . $options['controller'] . '.' . $options['action'];
        $resource = strtolower($mac);

        $acl = new Custom_Acl();
        $doctrine = Zend_Registry::get('doctrine');

        if (Zend_Auth::getInstance()->hasIdentity()) {
            $accountId = Zend_Auth::getInstance()->getIdentity()
                            ->getId();


            $modelRoleMembers = $doctrine->_em->getRepository('Auth_Model_RoleMember');
            $roles = $modelRoleMembers->findBy(array('account_id' => $accountId));

            $allowed = false;
            foreach ($roles as $role) {
                $modelRoles = $doctrine->_em->getRepository('Auth_Model_Role');
                $roleData = $modelRoles->findOneBy(array('id' => $role->getRole_id()));
                if ($acl->has($resource) && $acl->isAllowed($roleData->getName(), $resource)) {
                    $allowed = true;
                }
            }
        } else {
            $allowed = false;
            $modelRoles = $doctrine->_em->getRepository('Auth_Model_Role');
            if ($acl->has($resource) && $acl->isAllowed('guest', $resource)) {
                $allowed = true;
            }
        }

        if (!$allowed) {
            $return = false;
        } else {
            $return = true;
        }
        return $return;
    }

}