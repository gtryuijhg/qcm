<?php
namespace Aftral\Qcm\Library\FormInitializer\AppAdmin;

use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminForm\AppAdminUpdateForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;


/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminUpdateFormInitializer extends FormInitializer
{
    private $_appAdminUpdateForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_appAdminUpdateForm = new AppAdminUpdateForm([
                'appAdminPassword' => $this->request()->postData('appAdminPassword'),
                'newAppAdminPassword' => $this->request()->postData('newAppAdminPassword'),
                'confirmNewAppAdminPassword' => $this->request()->postData('confirmNewAppAdminPassword')
            ]);
        }
        else
        {
            $this->_appAdminUpdateForm = new AppAdminUpdateForm([]);
        }
        
        return $this->_appAdminUpdateForm;
    }
}

