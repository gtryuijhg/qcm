<?php
namespace Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserLoginSearchDatabase extends Entity
{
    private $_appUserLogin;
    
    /**
     * 
     * @return string/NULL
     */
    public function appUserLogin()
    {
        if (!empty($this->_appUserLogin))
        {
            return $this->_appUserLogin;
        }
    }
    
    /**
     * 
     * @param string/NULL $appUserLogin
     */
    public function setAppUserLogin($appUserLogin):void
    {
        if (is_string($appUserLogin))
        {
            $this->_appUserLogin = $appUserLogin;
        }
    }
}

