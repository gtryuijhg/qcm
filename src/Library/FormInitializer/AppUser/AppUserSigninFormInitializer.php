<?php
namespace Aftral\Qcm\Library\FormInitializer\AppUser;

use Aftral\Qcm\Library\Entities\AppUser\AppUserForm\AppUserSigninForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserSigninFormInitializer extends FormInitializer
{
    private $_appUserSigninForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_appUserSigninForm = new AppUserSigninForm([
                'appUserLogin' => $this->request()->postData('appUserLogin'),
                'appUserPassword' => $this->request()->postData('appUserPassword')
            ]);            
        }
        else
        {
            $this->_appUserSigninForm = new AppUserSigninForm([]);
        }
        
        return $this->_appUserSigninForm;
    }
}

