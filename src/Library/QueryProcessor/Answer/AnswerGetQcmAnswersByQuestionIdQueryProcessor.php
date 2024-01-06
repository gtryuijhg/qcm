<?php
namespace Aftral\Qcm\Library\QueryProcessor\Answer;

use Aftral\Qcm\Library\QueryProcessor\QueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerGetQcmAnswersByQuestionIdQueryProcessor extends QueryProcessor
{
    private $_questionId;
    private $_isSolution;
    
    public function __construct($dao, $sql, $questionId, $isSolution)
    {
        parent::__construct($dao, $sql);
        
        $this->_questionId = $questionId;
        $this->_isSolution = $isSolution;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\QueryProcessor\QueryProcessor::process()
     */
    public function process()
    {
        $query = $this->dao()->prepare($this->sql());        
        $query->bindValue(':questionId', $this->_questionId, \PDO::PARAM_INT);
        $query->bindValue(':isSolution', $this->_isSolution, \PDO::PARAM_STR);
        
        $query->execute();
        
        return $query;
    }
}

