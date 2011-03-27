<?php
/**
 * @Table(name="accounts")
 * @Entity(repositoryClass="Auth_Model_AccountRepository")
 */
class Auth_Model_Account {

    /**
     * @var integer $id
     * @Id @Column(type="integer") 
     * @GeneratedValue
     */
    private $id;

    /**
     * @var string $name
     * @Column(type="string")
     */
    private $name;
    
    /**
     * @var string $email
     * @Column(type="string")
     */
    private $email;
    
    /**
     * @var string $password
     * @Column(type="string")
     */
    private $password;
    
    /**
     * @var string $created_at
     * @Column(type="string")
     */
    private $created_at;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password, $hash)
    {
        if (empty($hash)) {
            throw new Exception('Hash required (2nd argument): use $object->setPassword($password, $hash)');
        }
        # move salt to config file
        $this->password = hash('SHA256', $hash . $password);
    }

    /**
     * Get password
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set created_at
     *
     * @param string $created_at
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * Get created_at
     *
     * @return string $created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }
}