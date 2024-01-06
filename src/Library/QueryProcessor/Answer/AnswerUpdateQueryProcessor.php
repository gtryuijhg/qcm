<?php
namespace Aftral\Qcm\Library\QueryProcessor\Answer;

use Aftral\Qcm\Library\QueryProcessor\QueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerUpdateQueryProcessor extends QueryProcessor
{
    private $_answer;
    
    public function __construct($dao, $sql, $answer)
    {
        parent::__construct($dao, $sql);
        
        $this->_answer = $answer;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\QueryProcessor\QueryProcessor::process()
     */
    public function process()
    {
        $query = $this->dao()->prepare($this->sql());
        $query->bindValue(':id', $this->_answer->id(), \PDO::PARAM_INT);
        $query->bindValue(':answerBody', $this->_answer->answerBody(), \PDO::PARAM_STR);
        $query->bindValue(':questionId', $this->_answer->questionId(), \PDO::PARAM_INT);
        $query->bindValue(':isSolution', $this->_answer->isSolution(), \PDO::PARAM_STR);
        
        $query->execute();
        $query->closeCursor();
    }
}

