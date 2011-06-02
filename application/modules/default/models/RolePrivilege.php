<?php
/**
 * @Table(name="acl_rolePrivileges")
 * @Entity(repositoryClass="Default_Model_RolePrivilegeRepository")
 */
class Default_Model_RolePrivilege {
    /**
     * @var integer $id
     * @Id @Column(type="integer") 
     * @GeneratedValue
     */
    private $id;
    
    /**
     * @var integer $role_id
     * @Column(type="integer")
     */
    private $role_Id;
    
    /**
     * @var integer $privilege_id
     * @Column(type="integer")
     */
    private $privilege_Id;
    
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $role_Id
	 */
	public function getRole_Id() {
		return $this->role_Id;
	}

	/**
	 * @return the $privilege_Id
	 */
	public function getPrivilege_Id() {
		return $this->privilege_Id;
	}

	/**
	 * @param integer $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param integer $role_Id
	 */
	public function setRole_Id($role_Id) {
		$this->role_Id = $role_Id;
	}

	/**
	 * @param integer $privilege_Id
	 */
	public function setPrivilege_Id($privilege_Id) {
		$this->privilege_Id = $privilege_Id;
	}

}