<?php
namespace Aftral\Qcm\Library\QueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class QueryProcessor
{
    private $_dao;
    private $_sql;
    
    public function __construct($dao, $sql)
    {
        $this->setDao($dao);
        $this->setSql($sql);
    }
    
    public function setDao($dao)
    {
        $this->_dao = $dao;
    }
    
    public function setSql($sql)
    {
        $this->_sql = $sql;
    }
    
    public function dao()
    {
        return $this->_dao;
    }
    
    public function sql()
    {
        return $this->_sql;
    }
       
    abstract public function process();
}

