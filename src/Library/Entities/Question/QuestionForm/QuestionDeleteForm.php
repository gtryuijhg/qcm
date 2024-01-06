<?php
namespace Aftral\Qcm\Library\Entities\Question\QuestionForm;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionDeleteForm extends Entity
{
    private $_appAdminPassword;
    
    /**
     * 
     * @return string/NULL
     */
    public function appAdminPassword()
    {
        if (!empty($this->_appAdminPassword))
        {
            return $this->_appAdminPassword;
        }
    }
    
    /**
     * 
     * @param string/NULL $appAdminPassword
     */
    public function setAppAdminPassword($appAdminPassword):void
    {
        if (is_string($appAdminPassword))
        {
            $this->_appAdminPassword = $appAdminPassword;
        }
    }
}

