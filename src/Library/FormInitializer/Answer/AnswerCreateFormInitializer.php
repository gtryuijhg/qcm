<?php
namespace Aftral\Qcm\Library\FormInitializer\Answer;

use Aftral\Qcm\Library\FormInitializer\FormInitializer;
use Aftral\Qcm\Library\Entities\Answer\AnswerForm\AnswerCreateForm;
use Aftral\Qcm\Library\Entities\Question\QuestionDatabase\QuestionDatabase;
use Aftral\Qcm\Library\Core\HTTPRequest;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerCreateFormInitializer extends FormInitializer
{
    private $_answerCreateForm;
    private $_questionInBase;
    
    public function __construct(HTTPRequest $request, QuestionDatabase $questionInBase)
    {
        parent::__construct($request);
        
        $this->_questionInBase = $questionInBase;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormInitializer\FormInitializer::initialize()
     */
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_answerCreateForm = new AnswerCreateForm([
                'answerBody' => $this->request()->postData('answerBody'),
                'isSolution' => $this->request()->postData('isSolution'),
                'questionId' => $this->_questionInBase->id()
            ]);          
        }
        else
        {
            $this->_answerCreateForm = new AnswerCreateForm([]);
        }
        
        return $this->_answerCreateForm;
    }
}

