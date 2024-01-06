<?php
namespace Aftral\Qcm\Library\Models;

use Aftral\Qcm\Library\Entities\Question\QuestionDatabase\QuestionDatabase;
use Aftral\Qcm\Library\Entities\Question\QuestionDatabase\QuestionSearchDatabase;
use Aftral\Qcm\Library\QueryProcessor\Question\QuestionDeleteQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Question\QuestionGetByIdQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Question\QuestionGetListByTypeQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Question\QuestionGetListQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Question\QuestionInsertQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Question\QuestionSearchQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Question\QuestionUpdateQueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionManagerPDO extends QuestionManager
{
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\QuestionManager::searchQuestion()
     */
    public function searchQuestion(QuestionSearchDatabase $question)
    {
        $sql = 'SELECT id, questionBody, questionType, solutionsNumber FROM questions WHERE questionBody = :questionBody AND questionType = :questionType AND solutionsNumber = :solutionsNumber';
        
        $queryProcessor = new QuestionSearchQueryProcessor($this->dao(), $sql, $question);
        $query = $queryProcessor->process();
        
        //si on trouve la question
        if ($questionInBase = $query->fetch())
        {
            $questionInBase = new QuestionDatabase($questionInBase);
        }
        
        $query->closeCursor();
        
        return $questionInBase;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\QuestionManager::add()
     */
    protected function add(QuestionDatabase $question)
    {
        $sql = 'INSERT INTO questions (questionBody, questionType, solutionsNumber) VALUES (:questionBody, :questionType, :solutionsNumber)';
        
        $queryProcessor = new QuestionInsertQueryProcessor($this->dao(), $sql, $question);
        $queryProcessor->process();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\QuestionManager::getQuestionList()
     */
    public function getQuestionList()
    {
        $sql = 'SELECT id, questionBody, questionType, solutionsNumber FROM questions';
        
        $queryProcessor = new QuestionGetListQueryProcessor($this->dao(), $sql);
        $query = $queryProcessor->process();
        
        if ($questionList = $query->fetchAll())
        {
            $query->closeCursor();
            
            return $questionList;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\QuestionManager::searchQuestionById()
     */
    public function searchQuestionById(int $id)
    {
        $sql = 'SELECT id, questionBody, questionType, solutionsNumber FROM questions WHERE id = :id';
       
        $queryProcessor = new QuestionGetByIdQueryProcessor($this->dao(), $sql, $id);
        $query = $queryProcessor->process();
        
        if ($questionInBase = $query->fetch())
        {
            $questionInBase = new QuestionDatabase($questionInBase);
        }
        
        $query->closeCursor();
        
        return $questionInBase;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\QuestionManager::delete()
     */
    public function delete(int $id)
    {
        $sql = 'DELETE FROM questions WHERE id = :id';
        
        $queryProcessor = new QuestionDeleteQueryProcessor($this->dao(), $sql, $id);
        $queryProcessor->process();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\QuestionManager::modify()
     */
    protected function modify(QuestionDatabase $question)
    {
        $sql = 'UPDATE questions SET questionBody = :questionBody, questionType = :questionType, solutionsNumber = :solutionsNumber WHERE id = :id';
        
        $queryProcessor = new QuestionUpdateQueryProcessor($this->dao(), $sql, $question);
        $queryProcessor->process();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\QuestionManager::getIdQuestionList()
     */
    public function getQuestionListByType(string $questionType)
    {
        $sql = 'SELECT id, questionBody, questionType FROM questions WHERE questionType = :questionType';
        
        $queryProcessor = new QuestionGetListByTypeQueryProcessor($this->dao(), $sql, $questionType);
        $query = $queryProcessor->process();
        
        if ($listQuestion = $query->fetchAll())
        {
            $query->closeCursor();
            
            return $listQuestion;
        }
    }


}

