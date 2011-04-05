<?php
/**
 * Account Repository
 *
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */

use Doctrine\ORM\EntityRepository;
class Auth_Model_AccountRepository extends EntityRepository
{
    /**
     * Authenticate user
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           void
     *
     */
    public function authenticate($hash, $data)
    {
        # filter data
        if (empty($hash)) {
            throw new Exception('Hash required to Authenticate');
        }
        if (empty($data['email']) || empty($data['password'])) {
            throw new Exception('Email & Password required. You only supplied ' . $data);
        }

        # get data
        $result = $this->findOneBy(array(
                            'email' => (string) $data['email'],
                            'password' => (string) hash('SHA256', $hash . $data['password']) 
                         ));

        return $result;
    }
    
    /**
     * Check if account with this email exists
	 * 
     * @author Koen Huybrechts
     */
    
    public function checkEmail($data)
    {
    	$result = $this->findOneBy(array(
    		'email' => (string) $data['email']
    	));
    	
    	if(count($result) != 1) {
    		throw new Exception('FAILURE_IDENTITY_NOT_FOUND');
    	}
    	
    	return $result;
    }

}