<?php
namespace Aftral\Qcm\Library\Entities\AppUser\AppUserForm;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserUpdateByAdminForm extends Entity
{
    private $_newAppUserPassword;
    private $_confirmNewAppUserPassword;
    private $_appAdminPassword;
    
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
     * @return string/NULL
     */
    public function appAdminPassword()
    {
        if (!empty($this->_appAdminPassword))
        {
            return $this->_appAdminPassword;
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
    
    /**
     * 
     * @param string/NULL $appAdminPassword
     */
    public function setAppAdminPassword($appAdminPassword):void
    {
        if (is_string($appAdminPassword))
        {
            $this->_appAdminPassword = $appAdminPassword;
        }
    }
}

