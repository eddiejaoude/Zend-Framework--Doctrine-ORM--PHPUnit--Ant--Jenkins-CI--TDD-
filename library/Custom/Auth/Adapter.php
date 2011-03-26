<?php
/**
 * Custom Auth Adapter method
 *
 * @author          Eddie Jaoude
 */
class Custom_Auth_Adapter implements Zend_Auth_Adapter_Interface
{
    /**
     * constructor  method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function __construct($model , $hash, $data)
    {
        $this->model= $model;
        $this->hash = $hash;
        $this->data = $data;
    }

    /**
     * authentication method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function authenticate() {
        $account = $this->model
                        ->findBy(array(
                            'email' => (string) $this->data['email'],
                            'password' => (string) hash('SHA256', $this->_hash . $this->data['password']) // move hash to model
                         ));
        if (count($account) === 1) {
            $status = Zend_Auth_Result::SUCCESS;
        } else {
            $status = Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND;
        }
        $result = new Zend_Auth_Result($status, $account);
        return $result;
    }

}