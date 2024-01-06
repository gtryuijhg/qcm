<?php
namespace Aftral\Qcm\Library\Entities\AppUser\AppUserForm;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserDeleteForm extends Entity
{
    private $_appUserPassword;
    
    /**
     * 
     * @return string/NULL
     */
    public function appUserPassword()
    {
        if (!empty($this->_appUserPassword))
        {
            return $this->_appUserPassword;
        }
    }
    
    /**
     * 
     * @param string/NULL $appUserPassword
     */
    public function setAppUserPassword($appUserPassword):void
    {
        if (is_string($appUserPassword))
        {
            $this->_appUserPassword = $appUserPassword;
        }
    }
}

