<?php
namespace Aftral\Qcm\Library\QueryProcessor\Answer;

use Aftral\Qcm\Library\QueryProcessor\QueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerCountQueryProcessor extends QueryProcessor
{
    private $_id;
    private $_isSolution;
    
    public function __construct($dao, $sql, $id, $isSolution)
    {
        parent::__construct($dao, $sql);
        
        $this->_id = $id;
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
        $query->bindValue(':questionId', $this->_id, \PDO::PARAM_INT);
        $query->bindValue(':isSolution', $this->_isSolution, \PDO::PARAM_STR);
        
        $query->execute();
        
        return $query;
    }
}

