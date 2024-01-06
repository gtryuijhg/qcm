<?php
namespace Aftral\Qcm\Library\Core;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class Entity
{
    private $_id;
    
    /**
     * 
     * @param $data
     */
    public function __construct($data)
    {
        if (!empty($data))
        {
            $this->hydrate($data);
        }
    }
    
    /**
     * 
     * @param array $data
     */
    public function hydrate($data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            
            if (is_callable([$this, $method]))
            {
                $this->$method($value);
            }
        }
    }
    
    /**
     * 
     * @return boolean
     */
    public function isNew():bool
    {
        return empty($this->_id);
    }
    
    /**
     * 
     * @return int id
     */
    public function id()
    {
        return $this->_id;
    }
    
    /**
     * 
     * @param int $id
     */
    public function setId(int $id):void
    {
        if ($id > 0)
        {
            $this->_id = $id;
        }
    }
}

