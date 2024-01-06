<?php
namespace Aftral\Qcm\Library\Models;

use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerDatabase;
use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerSearchDatabase;
use Aftral\Qcm\Library\QueryProcessor\Answer\AnswerCountQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Answer\AnswerDeleteQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Answer\AnswerGetAllLinkedQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Answer\AnswerGetByIdQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Answer\AnswerGetListQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Answer\AnswerGetQcmAnswersByQuestionIdQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Answer\AnswerGetQcmSolutionsByQuestionIdQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Answer\AnswerInsertQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Answer\AnswerSearchQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\Answer\AnswerUpdateQueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerManagerPDO extends AnswerManager
{

    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AnswerManager::add()
     */
    protected function add(AnswerDatabase $answer)
    {       
        $sql = 'INSERT INTO answers (answerBody, questionId, isSolution) VALUES (:answerBody, :questionId, :isSolution)';
        
        $queryProcessor = new AnswerInsertQueryProcessor($this->dao(), $sql, $answer);
        $queryProcessor->process();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AnswerManager::searchIfExists()
     */
    public function searchIfExists(AnswerSearchDatabase $answer)
    {
        $sql = 'SELECT id, answerBody, questionid, isSolution FROM answers WHERE answerBody = :answerBody AND questionId = :questionId AND isSolution = :isSolution';
        
        $queryProcessor = new AnswerSearchQueryProcessor($this->dao(), $sql, $answer);
        $query = $queryProcessor->process();
        
        //si on trouve la réponse
        if ($answerInBase = $query->fetch())
        {
            $answerInBase = new AnswerDatabase($answerInBase);
        }
        
        $query->closeCursor();
        
        return $answerInBase;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AnswerManager::getAnswerList()
     */
    public function getAnswerList()
    {
        $sql = 'SELECT id, answerBody, questionId, isSolution FROM answers';
        
        $queryProcessor = new AnswerGetListQueryProcessor($this->dao(), $sql);
        $query = $queryProcessor->process();
        
        //on liste les résultats
        if ($answerList = $query->fetchAll())
        {
            $query->closeCursor();
            
            return $answerList;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AnswerManager::searchAnswerById()
     */
    public function searchAnswerById(int $id)
    {
        $sql = 'SELECT id, answerBody, questionId, isSolution FROM answers WHERE id = :id';
        
        $queryProcessor = new AnswerGetByIdQueryProcessor($this->dao(), $sql, $id);
        $query = $queryProcessor->process();
        
        //si on trouve la réponse
        if ($answerInBase = $query->fetch())
        {
            $answerInBase = new AnswerDatabase($answerInBase);
        }
        
        $query->closeCursor();
        
        return $answerInBase;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AnswerManager::modify()
     */
    protected function modify(AnswerDatabase $answer)
    {
        $sql = 'UPDATE answers SET answerBody = :answerBody, questionId = :questionId, isSolution = :isSolution WHERE id = :id';
        
        $queryProcessor = new AnswerUpdateQueryProcessor($this->dao(), $sql, $answer);
        $queryProcessor->process();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AnswerManager::searchAllLinkedAnswers()
     */
    public function searchAllLinkedAnswers(int $id)
    {
        $sql = 'SELECT id, answerBody, questionId, isSolution FROM answers WHERE questionId = :questionId';
        
        $queryProcessor = new AnswerGetAllLinkedQueryProcessor($this->dao(), $sql, $id);
        $query = $queryProcessor->process();
        
        //on liste les résultats
        if ($listAnswers = $query->fetchAll())
        {
            $query->closeCursor();
            
            return $listAnswers;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AnswerManager::delete()
     */
    public function delete(int $id)
    {
        $sql = 'DELETE FROM answers WHERE id = :id';
        
        $queryProcessor = new AnswerDeleteQueryProcessor($this->dao(), $sql, $id);
        $queryProcessor->process();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AnswerManager::countSolutions()
     */
    public function getSolutions(int $id, String $isSolution)
    {
        $sql = 'SELECT COUNT(*) AS solutionsNumber FROM answers WHERE questionId = :questionId AND isSolution = :isSolution';
        
        $queryProcessor = new AnswerCountQueryProcessor($this->dao(), $sql, $id, $isSolution);
        $query = $queryProcessor->process();
        
        if ($result = $query->fetch())
        {   
            $solutionsNumber = $result['solutionsNumber'];
            
            $query->closeCursor();
            
            return $solutionsNumber;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AnswerManager::getQcmSolutionsById()
     */
    public function getQcmSolutionsByQuestionId(int $questionId, string $isSolution)
    {
        $sql = 'SELECT id, questionId, answerBody, isSolution FROM answers WHERE questionId = :questionId AND isSolution = :isSolution';
        
        $queryProcessor = new AnswerGetQcmSolutionsByQuestionIdQueryProcessor($this->dao(), $sql, $questionId, $isSolution);
        $query = $queryProcessor->process();
        
        if ($solutionsList = $query->fetchAll())
        {            
            $query->closeCursor();
            
            return $solutionsList;
        }
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AnswerManager::getQcmAnswersById()
     */
    public function getQcmAnswersByQuestionId(int $questionId, string $isSolution)
    {
        $sql = 'SELECT id, questionId, answerBody, isSolution FROM answers WHERE questionId = :questionId AND isSolution = :isSolution';
        
        $queryProcessor = new AnswerGetQcmAnswersByQuestionIdQueryProcessor($this->dao(), $sql, $questionId, $isSolution);
        $query = $queryProcessor->process();
        
        if ($answersList = $query->fetch())
        {          
            $query->closeCursor();
            
            return $answersList;
        }
    }


}

