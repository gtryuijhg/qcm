<?php
namespace Aftral\Qcm\Library\Core;


/**
 * 
 * @author gregoire.huteau
 *
 */
class Managers
{
    private $_api = NULL;
    private $_dao = NULL;
    private $_managers = [];
    
    public function __construct($api, $dao)
    {
        $this->_api = $api;
        $this->_dao = $dao;
    }
    
    /**
     * 
     * @param string $module
     * @throws \InvalidArgumentException
     * @return array
     */
    public function getManagerOf(string $module)
    {
        if (!is_string($module) || empty($module))
        {
            throw new \InvalidArgumentException('Le module spécifié est invalide');
        }
        
        if (!isset($this->_managers[$module]))
        {
            $manager = 'Aftral\\Qcm\\Library\\Models\\'.$module.'Manager'.$this->_api;
            $this->_managers[$module] = new $manager($this->_dao);
        }
        
        return $this->_managers[$module];
    }
}

