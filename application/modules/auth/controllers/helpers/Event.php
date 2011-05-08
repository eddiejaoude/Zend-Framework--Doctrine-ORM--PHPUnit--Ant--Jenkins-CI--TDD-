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
     * Record event
     *
     * @author          Eddie Jaoude
     * @param           object $_em db event manager
     * @param           string $event
     * @return           void
     *
     */
    public function record($_em, $event, $user_id) {
        $account_event = new Auth_Model_AccountEvent;
        $account_event->setAccount_id($user_id);
        $account_event->setEvent($event);
        $date = new Zend_Date;
        $account_event->setCreated_at($date->toString('YYYY-MM-dd HH:mm:ss'));
        $_em->persist($account_event);
        $_em->flush();
    }
}