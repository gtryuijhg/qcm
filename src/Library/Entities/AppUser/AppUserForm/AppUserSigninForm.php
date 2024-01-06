<?php
namespace Aftral\Qcm\Library\Entities\AppUser\AppUserForm;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserSigninForm extends Entity
{
    private $_appUserLogin;
    private $_appUserPassword;
    
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
     * @param string/NULL $appUserLogin
     */
    public function setAppUserLogin($appUserLogin):void
    {
        if (is_string($appUserLogin))
        {
            $this->_appUserLogin = $appUserLogin;
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

