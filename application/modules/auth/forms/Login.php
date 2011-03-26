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
class Auth_Form_Login extends Zend_Form
{
	public function __construct($options = null)
	{
		parent::__construct($options);
		$this->setName('Login')
			 ->setMethod('post')
                        ->setAttrib('class', 'box')
			 ->setAction('/auth/login');
		
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
?>
