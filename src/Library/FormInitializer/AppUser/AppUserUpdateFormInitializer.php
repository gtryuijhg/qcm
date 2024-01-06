<?php
namespace Aftral\Qcm\Library\FormInitializer\AppUser;

use Aftral\Qcm\Library\Entities\AppUser\AppUserForm\AppUserUpdateForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserUpdateFormInitializer extends FormInitializer
{
    private $_appUserUpdateForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_appUserUpdateForm = new AppUserUpdateForm([
                'appUserPassword' => $this->request()->postData('appUserPassword'),
                'newAppUserPassword' => $this->request()->postData('newAppUserPassword'),
                'confirmNewAppUserPassword' => $this->request()->postData('confirmNewAppUserPassword')
            ]);
        }
        else
        {
            $this->_appUserUpdateForm = new AppUserUpdateForm([]);
        }
        
        return $this->_appUserUpdateForm;
    }
}

