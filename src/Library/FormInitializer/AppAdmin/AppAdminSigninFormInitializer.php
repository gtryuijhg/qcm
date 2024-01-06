<?php
namespace Aftral\Qcm\Library\FormInitializer\AppAdmin;

use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminForm\AppAdminSigninForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminSigninFormInitializer extends FormInitializer
{
    private $_appAdminSigninForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_appAdminSigninForm = new AppAdminSigninForm([
                'appAdminLogin' => $this->request()->postData('appAdminLogin'),
                'appAdminPassword' => $this->request()->postData('appAdminPassword')
            ]);
        }
        else
        {
            $this->_appAdminSigninForm = new AppAdminSigninForm([]);
        }
        
        return $this->_appAdminSigninForm;
    }
}

