<?php
namespace Aftral\Qcm\Library\Form;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QcmQuestionField extends Field
{
    private $_qcmQuestionBody;
    private $_qcmQuestionAnswers = [];
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Form\Field::buildWidget()
     */
    public function buildWidget()
    {
        $widget = '';
        
        $widget .= '<div class="form-group"><fieldset>'.$this->_qcmQuestionBody.' : ';
        
        foreach ($this->_qcmQuestionAnswers as $answer)
        {
            $widget .= $answer->buildWidget();
        }
        
        $widget .= '</fieldset></div>';
        
        return $widget;
    }
    
    public function qcmQuestionBody()
    {
        return $this->_qcmQuestionBody;
    }
    
    public function qcmQuestionAnswers()
    {
        return $this->_qcmQuestionAnswers;
    }
    
    /**
     * 
     * @param string/NULL $qcmQuestionBody
     */
    public function setQcmQuestionBody($qcmQuestionBody)
    {
        if (is_string($qcmQuestionBody))
        {
            $this->_qcmQuestionBody = $qcmQuestionBody;
        }
    }
    
    /**
     * 
     * @param array $qcmQuestionAnswers
     */
    public function setQcmQuestionAnswers(array $qcmQuestionAnswers):void
    {
        foreach ($qcmQuestionAnswers as $answer)
        {
            if (!in_array($answer, $this->_qcmQuestionAnswers))
            {
                $this->_qcmQuestionAnswers[] = $answer;
            }
        }
    }
}

