<?php
namespace Aftral\Qcm\Library\QueryProcessor\Question;

use Aftral\Qcm\Library\QueryProcessor\QueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionUpdateQueryProcessor extends QueryProcessor
{
    private $_question;
    
    public function __construct($dao, $sql, $question)
    {
        parent::__construct($dao, $sql);
        
        $this->_question = $question;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\QueryProcessor\QueryProcessor::process()
     */
    public function process()
    {
        $query = $this->dao()->prepare($this->sql());
        $query->bindValue(':id', $this->_question->id(), \PDO::PARAM_INT);
        $query->bindValue(':questionBody', $this->_question->questionBody(), \PDO::PARAM_STR);
        $query->bindValue(':questionType', $this->_question->questionType(), \PDO::PARAM_STR);
        $query->bindValue(':solutionsNumber', $this->_question->solutionsNumber(), \PDO::PARAM_INT);
        
        $query->execute();
        $query->closeCursor();
    }
}

