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
    public function authenticate($hash, $data)
    {
        $result = $this->findBy(array(
                            'email' => (string) $data['email'],
                            'password' => (string) hash('SHA256', $hash . $data['password']) // move hash to model
                         ));
        return $result;
    }

}