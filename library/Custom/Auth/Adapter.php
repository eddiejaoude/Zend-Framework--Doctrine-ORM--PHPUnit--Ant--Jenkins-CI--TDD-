<?php
class Custom_Auth_Adapter implements Zend_Auth_Adapter_Interface
{
    public function __construct($username , $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticate() {
        return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, '');
    }

}