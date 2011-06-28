<?php

/**
 * @Table(name="acl_privileges")
 * @Entity(repositoryClass="Auth_Model_RoleRepository")
 */
class Auth_Model_Privilege {


    /**
     * @var integer $id
     * @Id @Column(type="integer") 
     * @GeneratedValue
     */
    private $id;
    /**
     * @var string $module
     * @Column(type="string")
     */
    private $module;
    /**
     * @var string $controller
     * @Column(type="string")
     */
    private $controller;
    /**
     * @var string $action
     * @Column(type="string")
     */
    private $action;
    /**
     * @var string $description
     * @Column(type="string")
     */
    private $description;


    /**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return the $module
     */
    public function getModule() {
        return $this->module;
    }

    /**
     * @return the $controller
     */
    public function getController() {
        return $this->controller;
    }

    /**
     * @return the $action
     */
    public function getAction() {
        return $this->action;
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
     * @param string $module
     */
    public function setModule($module) {
        $this->module = $module;
    }

    /**
     * @param string $controller
     */
    public function setController($controller) {
        $this->controller = $controller;
    }

    /**
     * @param string $action
     */
    public function setAction($action) {
        $this->action = $action;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

}