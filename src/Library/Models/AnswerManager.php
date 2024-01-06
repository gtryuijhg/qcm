<?php
namespace Aftral\Qcm\Library\Models;

use Aftral\Qcm\Library\Core\Manager;
use Aftral\Qcm\Library\Entities\Answer;
use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerDatabase;
use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerSearchDatabase;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class AnswerManager extends Manager
{
    /**
     * 
     * @param Answer $answer
     */
    public function save(AnswerDatabase $answer)
    {
        $answer->isNew() ? $this->add($answer) : $this->modify($answer);
    }
    
    /**
     * 
     * @param Answer $answer
     */
    abstract protected function add(AnswerDatabase $answer);
    
    /**
     * 
     * @param Answer $answer
     */
    abstract protected function modify(AnswerDatabase $answer);
    
    /**
     * 
     * @param AnswerSearchDatabase $answer
     */
    abstract public function searchIfExists(AnswerSearchDatabase $answer);
    
    abstract public function getAnswerList();
    
    /**
     * 
     * @param int $id
     */
    abstract public function searchAnswerById(int $id);
    
    /**
     * 
     * @param int $id
     */
    abstract public function searchAllLinkedAnswers(int $id);
    
    /**
     * 
     * @param int $id
     */
    abstract public function delete(int $id);
    
    /**
     * 
     * @param int $id
     * @param string isSolution
     */
    abstract public function getSolutions(int $id, String $isSolution);
    
    abstract public function getQcmSolutionsByQuestionId(int $questionId, string $isSolution);
    
    abstract public function getQcmAnswersByQuestionId(int $questionId, string $isSolution);
}

