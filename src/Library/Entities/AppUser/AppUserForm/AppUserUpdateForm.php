<?php
namespace Aftral\Qcm\Library\Entities\AppUser\AppUserForm;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserUpdateForm extends Entity
{
    private $_appUserPassword;
    private $_newAppUserPassword;
    private $_confirmNewAppUserPassword;
    
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
     * @return string/NULL
     */
    public function newAppUserPassword()
    {
        if (!empty($this->_newAppUserPassword))
        {
            return $this->_newAppUserPassword;
        }
    }
    
    /**
     * 
     * @return string/NULL
     */
    public function confirmNewAppUserPassword()
    {
        if (!empty($this->_confirmNewAppUserPassword))
        {
            return $this->_confirmNewAppUserPassword;
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
    
    /**
     * 
     * @param string/NULL $newAppUserPassword
     */
    public function setNewAppUserPassword($newAppUserPassword):void
    {
        if (is_string($newAppUserPassword))
        {
            $this->_newAppUserPassword = $newAppUserPassword;
        }
    }
    
    /**
     * 
     * @param string/NULL $confirmNewAppUserPassword
     */
    public function setConfirmNewAppUserPassword($confirmNewAppUserPassword):void
    {
        if (is_string($confirmNewAppUserPassword))
        {
            $this->_confirmNewAppUserPassword = $confirmNewAppUserPassword;
        }
    }
}

