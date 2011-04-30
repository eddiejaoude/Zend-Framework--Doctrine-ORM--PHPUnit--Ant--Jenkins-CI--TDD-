<?php
/**
 *
 * @author koen Huybrechts
 * @version 
 */

class Custom_Auth_Validate_NotIdentical extends Zend_Validate_Identical
{
	const Are_Equal = 'areEqual';
	protected $_messageTemplates = array(
	    self::Are_Equal => "'%value%' is identical to the current password"
	);
    public function isValid($value)
    {
        $validation =  !parent::isValid($value);
        if($validation) {
        	return true;
        } else {
        	$this->_error(self::Are_Equal);
        	return false;
        }
    }
}
