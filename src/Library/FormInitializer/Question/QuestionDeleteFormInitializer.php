<?php
namespace Aftral\Qcm\Library\FormInitializer\Question;

use Aftral\Qcm\Library\Entities\Question\QuestionForm\QuestionDeleteForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionDeleteFormInitializer extends FormInitializer
{
    private $_questionDeleteForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_questionDeleteForm = new QuestionDeleteForm([
                'appAdminPassword' => $this->request()->postData('appAdminPassword'),
                'id' => $this->request()->getData('id')
            ]);
        }
        else
        {
            $this->_questionDeleteForm = new QuestionDeleteForm([]);
        }
        
        return $this->_questionDeleteForm;
    }
}

