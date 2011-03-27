<?php

/**
 * Auth Login Form
 *
 * Authentication user form
 *
 * @author 			Eddie Jaoude
 * @category   		Real Browser
 * @package 		Auth Module
 * @version 		SVN: $Id:$
 *
 */
class Auth_Form_Register extends Zend_Form {

    public function __construct($options = null) {
        parent::__construct($options);
        $this->setName('Register')
                ->setMethod('post')
                ->setAttrib('class', 'box')
                ->setAction('/auth/register/');

        # Name	
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

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

        // spam code
        // Using both captcha and captchaOptions:
        $spamcode = new Zend_Form_Element_Captcha('spamcode',
                        array(
                            'label' => "Spam code - Please type what you see below in the empty form field under the spam code.",
                            'captcha' => 'Figlet',
                            'captchaOptions' => array(
                                'captcha' => 'Figlet',
                                'wordLen' => rand(5, 7),
                                'timeout' => 900,
                            ),
                ));

        # Submit
        $submit = new Zend_Form_Element_Submit('Register');

        # Create
        $this->addElements(array($name, $email, $password, $spamcode, $submit));
    }

}

?>
