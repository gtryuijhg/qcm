<?php
namespace Aftral\Qcm\Library\FormInitializer\AppUser;

use Aftral\Qcm\Library\Entities\AppUser\AppUserForm\AppUserRegisterForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserRegisterFormInitializer extends FormInitializer
{
    private $_appUserRegisterForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_appUserRegisterForm = new AppUserRegisterForm([
                'appUserFirstName' => $this->request()->postData('appUserFirstName'),
                'appUserLastName' => $this->request()->postData('appUserLastName'),
                'appUserLogin' => $this->request()->postData('appUserLogin'),
                'appUserPassword' => $this->request()->postData('appUserPassword'),
                'confirmAppUserPassword' => $this->request()->postData('confirmAppUserPassword')
            ]);
        }
        else
        {
            $this->_appUserRegisterForm = new AppUserRegisterForm([]);
        }
        
        return $this->_appUserRegisterForm;
    }
}

