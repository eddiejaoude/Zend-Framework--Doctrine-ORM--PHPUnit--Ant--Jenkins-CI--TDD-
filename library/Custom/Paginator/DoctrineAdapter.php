<?php
/**
 * Paginator Adapterfor Doctrine
 *
 * @author          Eddie Jaoude
 * @package         Library Module
 *
 */
class Custom_Paginator_DoctrineAdapter implements Zend_Paginator_Adapter_Interface
{

    /**
     * doctrine query
     *
     * @author          Eddie Jaoude
     * @param           object $_query
     *
     */
    protected $_query;
    
    /**
     * doctrine count query
     *
     * @author          Eddie Jaoude
     * @param           object $_count_query
     *
     */
    protected $_count_query;
    
    /**
     * Contruct method
     *
     * @author          Eddie Jaoude
     * @param           object $query
     * @return          void
     *
     */
    public function __construct($query)
    {
        $this->_query = $query;
        $this->_count_query = clone $query;
    }
    
    /**
     * Get items method
     *
     * @author          Eddie Jaoude
     * @param           int $offset
     * @param           int $itemsPerPage
     * @return          void
     *
     */
    public function getItems($offset, $itemsPerPage)
    { 
        return $this->_query
            ->setFirstResult($offset)
            ->setMaxResults($itemsPerPage)
            ->getQuery()
            ->getResult();
    }
    
    /**
     * Count method
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return          void
     *
     */
    public function count()
    { 
        return count($this->_count_query->getQuery()->getResult());
    }
    
}