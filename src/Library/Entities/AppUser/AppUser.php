<?php
namespace Aftral\Qcm\Library\Entities\AppUser;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUser extends Entity
{
    private $_appUserFirstName;
    private $_appUserLastName;
    
    /**
     *
     * @return string/NULL
     */
    public function appUserFirstName()
    {
        if (!empty($this->_appUserFirstName))
        {
            return $this->_appUserFirstName;
        }
    }
    
    /**
     *
     * @return string/NULL
     */
    public function appUserLastName()
    {
        if (!empty($this->_appUserLastName))
        {
            return $this->_appUserLastName;
        }
    }
    
    /**
     *
     * @param string/NULL $appUserFirstName
     */
    public function setAppUserFirstName($appUserFirstName):void
    {
        if (is_string($appUserFirstName))
        {
            $this->_appUserFirstName = $appUserFirstName;
        }
    }
    
    /**
     *
     * @param string/NULL $appUserLastName
     */
    public function setAppUserLastName($appUserLastName):void
    {
        if (is_string($appUserLastName))
        {
            $this->_appUserLastName = $appUserLastName;
        }
    }
}

