<?php
/**
 * Auth Password Reset Form
 * 
 * @author koen Huybrechts
 *
 */
class Auth_Form_PasswordReset extends Zend_Form
{
    public function __construct ($options = null)
    {
		parent::__construct($options);
		$this->setName('Login')
			 ->setMethod('post')
                        ->setAttrib('class', 'box')
			 ->setAction('/auth/password/forgot');
		
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
?>