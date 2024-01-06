<?php
namespace Aftral\Qcm\Library\FormInitializer\AppAdmin;

use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminForm\AppAdminRegisterForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminRegisterFormInitializer extends FormInitializer
{
    private $_appAdminRegisterForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_appAdminRegisterForm = new AppAdminRegisterForm([
                'appAdminFirstName' => $this->request()->postData('appAdminFirstName'),
                'appAdminLastName' => $this->request()->postData('appAdminLastName'),
                'appAdminLogin' => $this->request()->postData('appAdminLogin'),
                'appAdminPassword' => $this->request()->postData('appAdminPassword'),
                'confirmAppAdminPassword' => $this->request()->postData('confirmAppAdminPassword')
            ]);
        }
        else
        {
            $this->_appAdminRegisterForm = new AppAdminRegisterForm([]);
        }
        
        return $this->_appAdminRegisterForm;
    }
}

