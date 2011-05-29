<?php

/**
 * Auth password reset form
 * 
 * @author koen Huybrechts
 *
 */
class Auth_Form_PasswordReset extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post')
            ->setAction($this->getView()->url(array(
                    'module' => 'auth',
                    'controller' => 'password',
                    'action' => 'forgot')))
            ->setAttrib('class', 'box');

        # Email
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addFilter('StringToLower')
            ->addValidator('NotEmpty')
            ->addValidator('EmailAddress');

        # Submit
        $submit = new Zend_Form_Element_Submit('sendPassword', 'Resend Password');

        # Create
        $this->addElements(array($email, $submit));
    }
}
