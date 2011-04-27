<?php
/**
 *
 * @author koen Huybrechts
 * @version 
 */

class Custom_NotIdentical extends Zend_Validate_Identical
{
    public function isValid($value)
    {
        return !parent::isValid($value);
    }
}
