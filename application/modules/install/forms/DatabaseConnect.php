<?php
/**
 * Database Connect Form
 *
 * Input the connection to the database
 *
 * @author 			Koen Huybrechts
 * @package 		Install Module
 * @version 		SVN: $Id:$
 *
 */
class Install_Form_DatabaseConnect extends Zend_Form
{
	public function __construct($options = null)
	{
		parent::__construct($options);
		$this->setName('Database Connect')
			 ->setMethod('post')
			 ->setAction('/install/setup/database');
		
		# Server	
		$server = new Zend_Form_Element_Text('server');
		$server ->setLabel('Server Address')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addFilter('StringToLower')
				->addValidator('NotEmpty');
		
		# Username	
		$username = new Zend_Form_Element_Text('username');
		$username->setLabel('Server Address')
				 ->setRequired(true)
				 ->addFilter('StripTags')
				 ->addFilter('StringTrim')
				 ->addFilter('StringToLower')
				 ->addValidator('NotEmpty');
				
		# Password
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password')
				 ->setRequired(true)
				 ->addFilter('StripTags')
				 ->addFilter('StringTrim')
				 ->addValidator('NotEmpty');
				 
		# Get Available databases
		$databaseButton = new Zend_Form_Element_Button('databases');
		$databaseButton->setLabel('Get databases');
	
		# Submit
		$submit = new Zend_Form_Element_Submit('Setup Database');
		
		# Create
		$this->addElements(array($server, $username, $password, $databaseButton, $submit));
	}
}
?>
