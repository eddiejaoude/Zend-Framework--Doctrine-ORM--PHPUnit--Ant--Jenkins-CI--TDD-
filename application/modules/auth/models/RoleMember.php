<?php
/**
 * @Table(name="accounts_role_members")
 * @Entity(repositoryClass="Auth_Model_RoleMemberRepository")
 */
class Auth_Model_RoleMember {

    /**
     * @var integer $id
     * @Id @Column(type="integer") 
     * @GeneratedValue
     */
    private $id;
    
    /**
     * @var integer $account_id
     * @Column(type="integer")
     */
    private $account_id;
    
    /**
     * @var integer $role_id
     * @Column(type="integer")
     */
    private $role_id;
    
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $account_id
	 */
	public function getAccount_id() {
		return $this->account_id;
	}

	/**
	 * @return the $role_id
	 */
	public function getRole_id() {
		return $this->role_id;
	}

	/**
	 * @param integer $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param integer $account_id
	 */
	public function setAccount_id($account_id) {
		$this->account_id = $account_id;
	}

	/**
	 * @param integer $role_id
	 */
	public function setRole_id($role_id) {
		$this->role_id = $role_id;
	}

}