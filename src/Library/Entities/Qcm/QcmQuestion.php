<?php
namespace Aftral\Qcm\Library\Entities\Qcm;

use Aftral\Qcm\Library\Core\Entity;
use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerDatabase;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QcmQuestion extends Entity
{
    private $_questionBody;
    private $_answers = [];
    
    /**
     * 
     * @return string/NULL
     */
    public function questionBody()
    {
        if (!empty($this->_questionBody))
        {
            return $this->_questionBody;
        }
    }
    
    /**
     * 
     * @return array/NULL
     */
    public function answers()
    {
        if (!empty($this->_answers))
        {
            return $this->_answers;
        }
    }
    
    /**
     * 
     * @param string/NULL $questionBody
     */
    public function setQuestionBody($questionBody):void
    {
        if (is_string($questionBody))
        {
            $this->_questionBody = $questionBody;
        }
    }
    
    /**
     * 
     * @param array $answers
     */
    public function setAnswers(array $answers):void
    {
        foreach ($answers as $answer)
        {
            
            if ($answer instanceof AnswerDatabase && !in_array($answer, $this->_answers))
            {
                $this->_answers[] = $answer;
            }
        }
    }
}

