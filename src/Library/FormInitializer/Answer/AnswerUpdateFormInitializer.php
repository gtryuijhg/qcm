<?php
namespace Aftral\Qcm\Library\FormInitializer\Answer;

use Aftral\Qcm\Library\Core\HTTPRequest;
use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerDatabase;
use Aftral\Qcm\Library\Entities\Answer\AnswerForm\AnswerUpdateForm;
use Aftral\Qcm\Library\FormInitializer\FormInitializer;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerUpdateFormInitializer extends FormInitializer
{
    private $_answerUpdateForm;
    private $_answerInBase;
    
    public function __construct(HTTPRequest $request, AnswerDatabase $answerInBase)
    {
        parent::__construct($request);
        
        $this->_answerInBase = $answerInBase;
    }
    
    public function initialize()
    {
        if ($this->request()->method() == 'POST')
        {
            $this->_answerUpdateForm = new AnswerUpdateForm([
                'answerBody' => $this->request()->postData('answerBody'),
                'questionId' => $this->_answerInBase->questionId(),
                'isSolution' => $this->_answerInBase->isSolution(),
                'id' => $this->request()->getData('id')
            ]);
        }
        else
        {
            $this->_answerUpdateForm = new AnswerUpdateForm([
                'answerBody' => $this->_answerInBase->answerBody(),
                'questionId' => $this->_answerInBase->questionId(),
                'isSolution' => $this->_answerInBase->isSolution()
            ]);
        }
        
        return $this->_answerUpdateForm;
    }
}

