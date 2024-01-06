<?php
namespace Aftral\Qcm\Library\Entities\AppAdmin;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdmin extends Entity
{
    private $_appAdminFirstName;    
    private $_appAdminLastName;
    
    /**
     * 
     * @return string/NULL
     */
    public function appAdminFirstName()
    {
        if (!empty($this->_appAdminFirstName))
        {
            return $this->_appAdminFirstName;
        }
    }
    
    /**
     * 
     * @return string/NULL
     */
    public function appAdminLastName()
    {
        if (!empty($this->_appAdminLastName))
        {
            return $this->_appAdminLastName;
        }
    }
    
    /**
     * 
     * @param string/NULL $appAdminFirstName
     */
    public function setAppAdminFirstName($appAdminFirstName):void
    {
        if (is_string($appAdminFirstName))
        {
            $this->_appAdminFirstName = $appAdminFirstName;
        }           
    }
    
    /**
     * 
     * @param string/NULL $appAdminLastName
     */
    public function setAppAdminLastName($appAdminLastName):void
    {
        if (is_string($appAdminLastName))
        {
            $this->_appAdminLastName = $appAdminLastName;
        }
    }
}

