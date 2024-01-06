<?php
namespace Aftral\Qcm\Library\Entities\AppAdmin\AppAdminForm;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminUpdateForm extends Entity
{
    private $_appAdminPassword;
    private $_newAppAdminPassword;
    private $_confirmNewAppAdminPassword;
    
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
     * @return string/NULL
     */
    public function newAppAdminPassword()
    {
        if (!empty($this->_newAppAdminPassword))
        {
            return $this->_newAppAdminPassword;
        }
    }
    
    /**
     * 
     * @return string/NULL
     */
    public function confirmNewAppAdminPassword()
    {
        if (!empty($this->_confirmNewAppAdminPassword))
        {
            return $this->_confirmNewAppAdminPassword;
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
    
    /**
     * 
     * @param string/NULL $newAppAdminPassword
     */
    public function setNewAppAdminPassword($newAppAdminPassword):void
    {
        if (is_string($newAppAdminPassword))
        {
            $this->_newAppAdminPassword = $newAppAdminPassword;
        }
    }
    
    /**
     * 
     * @param string/NULL $confirmNewAppAdminPassword
     */
    public function setConfirmNewAppAdminPassword($confirmNewAppAdminPassword):void
    {
        if (is_string($confirmNewAppAdminPassword))
        {
            $this->_confirmNewAppAdminPassword = $confirmNewAppAdminPassword;
        }
    }
}

