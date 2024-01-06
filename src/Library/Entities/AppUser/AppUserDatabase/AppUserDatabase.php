<?php
namespace Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserDatabase extends Entity
{
    private $_appUserFirstName;
    private $_appUserLastName;
    private $_appUserLogin;
    private $_appUserPassword;
    
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
    
    /**
     * 
     * @param string/NULL $appUserLogin
     */
    public function setAppUserlogin($appUserLogin):void
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

