<?php
namespace Aftral\Qcm\Library\Entities\Qcm;

use Aftral\Qcm\Library\Core\Entity;
use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerDatabase;
use Aftral\Qcm\Library\Entities\Question\QuestionDatabase\QuestionDatabase;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QcmForm extends Entity
{
    private $_question;
    private $_questions = [];
    private $_answers = [];
    private $_solutions = [];
    
    /**
     * 
     * @return string/NULL
     */
    public function question()
    {
        if (!empty($this->_question))
        {
            return $this->_question;
        }
    }
    
    /**
     * 
     * @return string/NULL
     */
    public function answer()
    {
        if (!empty($this->_answer))
        {
            return $this->_answer;
        }
    }
    
    /**
     * 
     * @return array
     */
    public function questions()
    {
        if (!empty($this->_questions))
        {
            return $this->_questions;
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
     * @return array/NULL
     */
    public function solutions()
    {
        if (!empty($this->_solutions))
        {
            return $this->_solutions;
        }
    }
    
    /**
     * 
     * @param array $questions
     */
    public function setQuestions(array $questions)
    {
        foreach ($questions as $question)
        {
            if (!in_array($question, $this->_questions))
            {
                $this->_questions[] = $question;
            }           
        }
    }
    
    /**
     *
     * @param array $answers
     */
    public function setAnswers(array $answers)
    {
        foreach ($answers as $answer)
        {
            if (!in_array($answer, $this->_answers))
            {
                $this->_answers[] = $answer;
            }
        }
    }
    
    /**
     * 
     * @param array $solutions
     */
    public function setSolutions(array $solutions)
    {
        foreach ($solutions as $solution)
        {
            if (!in_array($solution, $this->_solutions))
            {
                $this->_solutions[] = $solution;
            }
        }
    }
}