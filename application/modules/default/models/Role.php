<?php
/**
 * @Table(name="acl_roles")
 * @Entity(repositoryClass="Default_Model_RoleRepository")
 */
class Default_Model_Role {
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
	
}