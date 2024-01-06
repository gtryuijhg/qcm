<?php
namespace Aftral\Qcm\Library\Entities\AppAdmin\AppAdminDatabase;

use Aftral\Qcm\Library\Core\Entity;

class AppAdminLoginSearchDatabase extends Entity
{
    private $appAdminLogin;
    
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
     * @param string/NULL $appAdminLogin
     */
    public function setAppAdminLogin($appAdminLogin)
    {
        if (is_string($appAdminLogin))
        {
            $this->_appAdminLogin = $appAdminLogin;
        }
    }
}

