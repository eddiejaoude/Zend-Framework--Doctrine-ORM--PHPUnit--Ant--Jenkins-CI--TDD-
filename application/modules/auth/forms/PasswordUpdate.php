<?php

/**
 * Auth password update form
 *
 * @author koen Huybrechts
 *
 */
class Auth_Form_PasswordUpdate extends Zend_Form
{

    public function init()
    {
        # Load the custom validator
        $this->addElementPrefixPath(
            'Custom_Auth_Validate',
            'Custom/Auth/Validate/',
            'validate'
        );

        $this->setMethod('post')
            ->setAction($this->getView()->url(array(
                    'module' => 'auth',
                    'controller' => 'password',
                    'action' => 'update')))
            ->setAttrib('class', 'box');

        # Current password
        $currentPassword = new Zend_Form_Element_Password('currentPassword');
        $currentPassword->setLabel('Current Password')
            ->setRequired(TRUE)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        # New password
        $newPassword = new Zend_Form_Element_Password('newPassword');
        $newPassword->setLabel('New Password')
            ->setRequired(TRUE)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        # Confirm new password
        $confirmPassword = new Zend_Form_Element_Password('confirmPassword');
        $confirmPassword->setLabel('Current Password')
            ->setRequired(TRUE)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        # Submit
        $submit = new Zend_Form_Element_Submit('sendPassword', 'Update Password');

        # Create
        $this->addElements(array($currentPassword, $newPassword, $confirmPassword, $submit));
    }
}
