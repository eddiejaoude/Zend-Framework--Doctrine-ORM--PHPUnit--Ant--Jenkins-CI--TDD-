<?php
/**
 * @Entity @Table(name="accounts")
 */
class Auth_Model_Account
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;
    /** @Column(length=50) */
    private $name; // type defaults to string
    
    public function getName() { return $this->name; }
}