<?php
namespace Aftral\Qcm\Library\Entities\AppAdmin\AppAdminDatabase;

use Aftral\Qcm\Library\Core\Entity;

class AppAdminByNameSearchDatabase extends Entity
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
     * @return striung/NULL
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
    public function setAppAdminFirstName($appAdminFirstName)
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
    public function setAppAdminLastName($appAdminLastName)
    {
        if (is_string($appAdminLastName))
        {
            $this->_appAdminLastName = $appAdminLastName;
        }
    }
}

