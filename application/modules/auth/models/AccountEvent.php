<?php
/**
 * @Table(name="account_events")
 * @Entity(repositoryClass="Auth_Model_AccountEventRepository")
 */
class Auth_Model_AccountEvent {

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
     * @var string $event
     * @Column(type="string")
     */
    private $event;

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
     * Get account_id
     *
     * @return integer $account_id
     */
    public function getAccount_id()
    {
        return $this->account_id;
    }

    /**
     * Set account_id
     *
     * @param integer $account_id
     */
    public function setAccount_id($account_id)
    {
        $this->account_id = $account_id;
    }

    /**
     * Set event
     *
     * @param string $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * Get event
     *
     * @return string $event
     */
    public function getEvent()
    {
        return $this->event;
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