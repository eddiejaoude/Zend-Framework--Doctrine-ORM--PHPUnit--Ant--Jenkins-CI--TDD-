<?php
/**
 * Auth Password Reset Form
 * 
 * @author koen Huybrechts
 *
 */
class Auth_Form_PasswordUpdate extends Zend_Form
{
    public function __construct ($options = null)
    {
    	# Load the custom validator
    	$this->addElementPrefixPath(
                'Custom_Auth_Validate',
                'Custom/Auth/Validate/',
                'validate'
        );
    	
		parent::__construct($options);
		$this->setName('Login')
			 ->setMethod('post')
                        ->setAttrib('class', 'box')
			 ->setAction('/auth/password/update');
		
		# Current password
		$currentPassword = new Zend_Form_Element_Password('currentPassword');
		$currentPassword->setLabel('Current Password')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		
		# New password
		$newPassword = new Zend_Form_Element_Password('newPassword');
		$newPassword->setLabel('New Password')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->addValidator('NotIdentical', false, array('token' => $data['currentPassword']))
				->addValidator('stringLength', false, array($data['length'], 100));
		
		# Confirm new password
		$confirmPassword = new Zend_Form_Element_Password('confirmPassword');
		$confirmPassword->setLabel('Current Password')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->addValidator('Identical', false, array('token' => $data['newPassword']));
	
		# Submit
		$submit = new Zend_Form_Element_Submit('sendPassword', 'Update Password');
		
		# Create
		$this->addElements(array($currentPassword, $newPassword, $confirmPassword, $submit));
    }
}
?>