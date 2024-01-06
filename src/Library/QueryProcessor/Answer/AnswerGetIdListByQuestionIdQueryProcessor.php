<?php
namespace Aftral\Qcm\Library\QueryProcessor\Answer;

use Aftral\Qcm\Library\QueryProcessor\QueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerGetIdListByQuestionIdQueryProcessor extends QueryProcessor
{
    private $_questionId;
    
    public function __construct($dao, $sql, $id)
    {
        parent::__construct($dao, $sql);
        
        $this->_questionId = $id;
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
        
        $query->execute();
        
        return $query;
    }
}

