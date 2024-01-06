<?php
namespace Aftral\Qcm\Library\Entities\AppAdmin\AppAdminForm;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminRegisterForm extends Entity
{
    private $_appAdminFirstName;
    private $_appAdminLastName;
    private $_appAdminLogin;
    private $_appAdminPassword;
    private $_confirmAppAdminPassword;
    
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
     * @return string/NULL
     */
    public function appAdminLogin()
    {
        if (!empty($this->_appAdminLogin))
        {
            return $this->_appAdminLogin;
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
     * @return string/NULL
     */
    public function confirmAppAdminPassword()
    {
        if (!empty($this->_confirmAppAdminPassword))
        {
            return $this->_confirmAppAdminPassword;
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
    
    /**
     * 
     * @param string/NULL $appAdminLogin
     */
    public function setAppAdminLogin($appAdminLogin):void
    {
        if (is_string($appAdminLogin))
        {
            $this->_appAdminLogin = $appAdminLogin;
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
     * @param string/NULL $confirmAppAdminPassword
     */
    public function setConfirmAppAdminPassword($confirmAppAdminPassword):void
    {
        if (is_string($confirmAppAdminPassword))
        {
            $this->_confirmAppAdminPassword = $confirmAppAdminPassword;
        }
    }
}

