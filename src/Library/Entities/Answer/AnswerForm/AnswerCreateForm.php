<?php
namespace Aftral\Qcm\Library\Entities\Answer\AnswerForm;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerCreateForm extends Entity
{
    private $_answerBody;
    private $_questionId;
    private $_isSolution;
    
    /**
     * 
     * @return string/NULL
     */
    public function answerBody()
    {
        if (!empty($this->_answerBody))
        {
            return $this->_answerBody;
        }
    }
    
    /**
     * 
     * @return int/NULL
     */
    public function questionId()
    {
        if (!empty($this->_questionId))
        {
            return $this->_questionId;
        }
    }
    
    /**
     * 
     * @return string
     */
    public function isSolution()
    {
        if (!empty($this->_isSolution))
        {
            return $this->_isSolution;
        }
    }
    
    /**
     * 
     * @param string/NULL $answerBody
     */
    public function setAnswerBody($answerBody):void
    {
        if (is_string($answerBody))
        {
            $this->_answerBody = $answerBody;
        }
    }
    
    /**
     * 
     * @param int $questionId
     */
    public function setQuestionId($questionId):void
    {
        $questionId = (int) $questionId;
        
        if ($questionId > 0)
        {
            $this->_questionId = $questionId;
        }
    }
    
    /**
     * 
     * @param string $isSolution
     */
    public function setIsSolution($isSolution):void
    {
        if (is_string($isSolution))
        {
            $this->_isSolution = $isSolution;
        }
    }
}

