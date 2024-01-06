<?php
namespace Aftral\Qcm\Library\FormInitializer\AppUser;

use Aftral\Qcm\Library\Entities\AppUser\AppUserForm\AppUserUpdateByAdminForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserUpdateByAdminFormInitializer extends FormInitializer
{
    private $_appUserUpdateByAdminForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_appUserUpdateByAdminForm = new AppUserUpdateByAdminForm([
                'newAppUserPassword' => $this->request()->postData('newAppUserPassword'),
                'confirmNewAppUserPassword' => $this->request()->postData('confirmNewAppUserPassword'),
                'appAdminPassword' => $this->request()->postData('appAdminPassword'),
                'id' => $this->request()->getData('id')
            ]);
        }
        else
        {
            $this->_appUserUpdateByAdminForm = new AppUserUpdateByAdminForm([]);
        }
        
        return $this->_appUserUpdateByAdminForm;
    }
}

