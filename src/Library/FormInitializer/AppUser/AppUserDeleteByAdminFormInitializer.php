<?php
namespace Aftral\Qcm\Library\FormInitializer\AppUser;

use Aftral\Qcm\Library\Entities\AppUser\AppUserForm\AppUserDeleteByAdminForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserDeleteByAdminFormInitializer extends FormInitializer
{
    private $_appUserDeleteByAdminForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_appUserDeleteByAdminForm = new AppUserDeleteByAdminForm([
                'appAdminPassword' => $this->request()->postData('appAdminPassword'),
                'id' => $this->request()->getData('id')
            ]);
        }
        else
        {
            $this->_appUserDeleteByAdminForm = new AppUserDeleteByAdminForm([]);
        }
        
        return $this->_appUserDeleteByAdminForm;
    }
}

