<?php

/**
 * @Table(name="acl_roles")
 * @Entity(repositoryClass="Auth_Model_RoleRepository")
 */
class Auth_Model_Role {

    public function __construct()
    {
        $this->rolePrivileges = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @var string $description
     * @Column(type="string")
     */
    private $description;

    /**
     * @var rolePrivileges $rolePrivileges
     * @OneToMany(targetEntity="Auth_Model_RolePrivilege", mappedBy="role")
     */
    private $rolePrivileges;

    /**
     * @return the $rolePrivileges
     */
    public function getRolePrivileges() {
        return $this->rolePrivileges;
    }

    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return the $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return the $description
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param integer $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

}