<?php
namespace Aftral\Qcm\Library\FormInitializer\Answer;

use Aftral\Qcm\Library\Entities\Answer\AnswerForm\AnswerDeleteForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerDeleteFormInitializer extends FormInitializer
{
    private $_answerDeleteForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_answerDeleteForm = new AnswerDeleteForm([
                'appAdminPassword' => $this->request()->postData('appAdminPassword'),
                'id' => $this->request()->getData('id')
            ]);
        }
        else
        {
            $this->_answerDeleteForm = new AnswerDeleteForm([]);
        }
        
        return $this->_answerDeleteForm;
    }
}

