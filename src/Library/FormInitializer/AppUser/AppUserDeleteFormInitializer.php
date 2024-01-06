<?php
namespace Aftral\Qcm\Library\FormInitializer\AppUser;

use Aftral\Qcm\Library\Entities\AppUser\AppUserForm\AppUserDeleteForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserDeleteFormInitializer extends FormInitializer
{
    private $_appUserDeleteForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_appUserDeleteForm = new AppUserDeleteForm([
                'appUserPassword' => $this->request()->postData('appUserPassword')
            ]);
        }
        else
        {
            $this->_appUserDeleteForm = new AppUserDeleteForm([]);
        }
        
        return $this->_appUserDeleteForm;
    }
}

