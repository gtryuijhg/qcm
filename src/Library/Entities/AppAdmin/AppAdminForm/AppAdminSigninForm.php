<?php
namespace Aftral\Qcm\Library\Entities\AppAdmin\AppAdminForm;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminSigninForm extends Entity
{
    private $_appAdminLogin;
    private $_appAdminPassword;
    
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
}

