<?php
namespace Aftral\Qcm\Library\Entities\Answer;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class Answer extends Entity
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
     * @return boolean/NULL
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
     * @param int/NULL $questionId
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
     * @param bool/NULL $isSolution
     */
    public function setIsSolution($isSolution):void
    {
        if ($isSolution == 'oui' || $isSolution == 'non')
        {
            $this->_isSolution = $isSolution;
        }
    }
}

