<?php
/**
 * Event action helper
 *
 *
 * @author          Eddie Jaoude
 * @package       Auth Module
 *
 */
class Auth_Controller_Helper_Event extends Zend_Controller_Action_Helper_Abstract
{

    /**
     * The default entity manager to use when one is not set
     * 
     * @var \Doctrine\Common\EntityManager
     */
    public static $defaultEntityManager;

    /**
     *
     * @var \Doctrine\ORM\EntityManager
     */
    protected $_em;
    
    /**
     * Record event
     *
     * @author          Eddie Jaoude
     * @param           string $event name of the event to record
     * @param           int $user_id id of the user generating the event
     * @param           \Doctrine\ORM\EntityManager $_em (optional) entity manager.
     * @return           void
     *
     */
    public function record($event, $user_id, $em = null) {
        $account_event = new Auth_Model_AccountEvent;
        $account_event->setAccount_id($user_id);
        $account_event->setEvent($event);
        $date = new Zend_Date;
        $account_event->setCreated_at($date->toString('YYYY-MM-dd HH:mm:ss'));

        if (null === $em){
            $em = $this->getEntityManager();
        }

        $em->persist($account_event);
        $em->flush();
    }

    /**
     * Get the entity manager in use
     *
     * @throws Exception
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->_em){
            if (Zend_Registry::isRegistered('EntityManager')){
                $this->_em = Zend_Registry::get('EntityManager');
            } else {
                if (null !== self::$defaultEntityManager){
                    $this->_em = self::$defaultEntityManager;
                } else {
                    throw new Exception('Entity manager not found');
                }
            }
        }
        return $this->_em;

    }

    /**
     * Set the entity manager to use
     *
     * @param <type> $em
     * @return \Auth_Controller_Helper_Event
     */
    public function setEntityManager($em)
    {
        $this->_em = $em;
        return $this;

    }
}