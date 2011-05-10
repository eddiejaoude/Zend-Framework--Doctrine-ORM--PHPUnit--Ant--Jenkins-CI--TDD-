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
		$username->setLabel('Username')
				 ->setRequired(true)
				 ->addFilter('StripTags')
				 ->addFilter('StringTrim')
				 ->addFilter('StringToLower')
				 ->addValidator('NotEmpty');
				
		# Password
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password')
				 ->addFilter('StripTags')
				 ->addFilter('StringTrim');
				 
	 	# Database Name
	 	$database = new Zend_Form_Element_Text('database');
	 	$database->setLabel('Database Name')
	 			 ->setRequired(true)
				 ->addFilter('StripTags')
				 ->addFilter('StringTrim')
                 ->addValidator('NotEmpty');
	
		# Submit
		$submit = new Zend_Form_Element_Submit('Setup Database');
		
		# Create
		$this->addElements(array($server, $username, $password, $database, $submit));
	}
}
?>
