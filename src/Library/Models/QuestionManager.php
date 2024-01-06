<?php
namespace Aftral\Qcm\Library\Models;

use Aftral\Qcm\Library\Core\Manager;
use Aftral\Qcm\Library\Entities\Question;
use Aftral\Qcm\Library\Entities\Question\QuestionDatabase\QuestionDatabase;
use Aftral\Qcm\Library\Entities\Question\QuestionDatabase\QuestionSearchDatabase;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class QuestionManager extends Manager
{
    /**
     * 
     * @param Question $question
     */
    abstract public function searchQuestion(QuestionSearchDatabase $question);
    
    /**
     * 
     * @param Question $question
     */
    public function save(QuestionDatabase $question)
    {
        $question->isNew() ? $this->add($question) : $this->modify($question);
    }
    
    /**
     * 
     * @param Question $question
     */
    abstract protected function add(QuestionDatabase $question);
    
    /**
     * 
     * @param Question $question
     */
    abstract protected function modify(QuestionDatabase $question);
    
    abstract public function getQuestionList();
    
    /**
     * 
     * @param int $id
     */
    abstract public function searchQuestionById(int $id);
    
    /**
     * 
     * @param int $id
     */
    abstract public function delete(int $id);
    
    /**
     * 
     * @param string $questionType
     */
    abstract public function getQuestionListByType(string $questionType);
}

