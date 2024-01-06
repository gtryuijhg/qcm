<?php
namespace Aftral\Qcm\Library\FormInitializer\AppAdmin;

use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminForm\AppAdminDeleteForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminDeleteFormInitializer extends FormInitializer
{
    private $_appAdminDeleteForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_appAdminDeleteForm = new AppAdminDeleteForm([
                'appAdminPassword' => $this->request()->postData('appAdminPassword')
            ]);
        }
        else
        {
            $this->_appAdminDeleteForm = new AppAdminDeleteForm([]);
        }
        
        return $this->_appAdminDeleteForm;
    }
}

