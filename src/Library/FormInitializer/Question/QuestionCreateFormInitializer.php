<?php
namespace Aftral\Qcm\Library\FormInitializer\Question;

use Aftral\Qcm\Library\Entities\Question\QuestionForm\QuestionCreateForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionCreateFormInitializer extends FormInitializer
{
    private $_questionCreateForm;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_questionCreateForm = new QuestionCreateForm([
                'questionBody' => $this->request()->postData('questionBody'),
                'questionType' => $this->request()->postData('questionType'),
                'solutionsNumber' => $this->request()->postData('solutionsNumber')
            ]);
        }
        else
        {
            $this->_questionCreateForm = new QuestionCreateForm([]);
        }
        
        return $this->_questionCreateForm;
    }
}

