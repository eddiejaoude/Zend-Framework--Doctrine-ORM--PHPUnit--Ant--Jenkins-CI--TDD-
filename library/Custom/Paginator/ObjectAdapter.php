<?php
/**
 * Paginator Adapter for Objects
 *
 * @author          Eddie Jaoude
 * @package         Custom Module
 *
 */
class Custom_Paginator_ObjectAdapter implements Zend_Paginator_Adapter_Interface
{

    /**
     * object
     *
     * @author          Eddie Jaoude
     * @param           object $_objects
     *
     */
    protected $_object;
    
    /**
     * count
     *
     * @author          Eddie Jaoude
     * @param           object $_count
     *
     */
    protected $_count;
    
    /**
     * Contruct method
     *
     * @author          Eddie Jaoude
     * @param           object $query
     * @return          void
     *
     */
    public function __construct(SimpleXMLElement $object)
    {
        $this->_object = $object;
        $this->_count = count($object);
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
        return $this->_object;
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
        return $this->_count;
    }
    
}