<?php
namespace Aftral\Qcm\Library\Entities\Question\QuestionForm;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionUpdateForm extends Entity
{
    private $_questionBody;
    private $_questionType;
    private $_solutionsNumber;
    
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
     * @return string/NULL
     */
    public function questionType()
    {
        if (!empty($this->_questionType))
        {
            return $this->_questionType;
        }
    }
    
    /**
     * 
     * @return int/NULL
     */
    public function solutionsNumber()
    {
        if (!empty($this->_solutionsNumber))
        {
            return $this->_solutionsNumber;
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
     * @param string/NULL $questionType
     */
    public function setQuestionType($questionType):void
    {
        if (is_string($questionType))
        {
            $this->_questionType = $questionType;
        }
    }
    
    /**
     * 
     * @param int/NULL $solutionsNumber
     */
    public function setSolutionsNumber($solutionsNumber):void
    {
        $solutionsNumber = (int) $solutionsNumber;
        
        if ($solutionsNumber > 0)
        {
            $this->_solutionsNumber = $solutionsNumber;
        }
    }
}

