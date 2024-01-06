<?php
namespace Aftral\Qcm\Library\Core;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class Manager
{
    private $_dao;
    
    /**
     * 
     * @param $dao
     */
    public function __construct($dao)
    {
        $this->_dao = $dao;
    }
    
    public function dao()
    {
        return $this->_dao;
    }
}

