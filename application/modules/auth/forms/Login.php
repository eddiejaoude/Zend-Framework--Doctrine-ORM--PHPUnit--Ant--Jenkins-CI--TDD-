<?php

/**
 * Auth login form
 *
 * @author 			Eddie Jaoude
 * @category   		Real Browser
 * @package 		Auth Module
 * @version 		SVN: $Id:$
 *
 */
class Auth_Form_Login extends Zend_Form
{

    public function init()
    {
        /*
         * Some people consider this to be "interface" stuff,
         * to be done in the view. Personally, I think 'action' and 'method'
         * can be done here, though the fact that we need the view object
         * in order to ender the url for the action suggests that it, too, should
         * be in the view. But 'name' and 'attribs' really are kind of view-ish.
         *
         * Still, I like the idea that the view-script is so simple, just render the form.
         *
         * @todo To be discussed.
         */
        $this->setMethod('post')
            ->setAction($this->getView()->url(array(
                    'module' => 'auth',
                    'controller' => 'login',
                    'action' => 'index')))
            ->setAttrib('class', 'box')
            ->setName('Login');

        # Email
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addFilter('StringToLower')
            ->addValidator('NotEmpty')
            ->addValidator('EmailAddress');

        # Password
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        # Submit
        $submit = new Zend_Form_Element_Submit('login');

        # Create
        $this->addElements(array($email, $password, $submit));
    }
}

