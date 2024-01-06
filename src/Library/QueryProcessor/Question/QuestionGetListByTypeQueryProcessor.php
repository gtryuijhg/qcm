<?php
namespace Aftral\Qcm\Library\QueryProcessor\Question;

use Aftral\Qcm\Library\QueryProcessor\QueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionGetListByTypeQueryProcessor extends QueryProcessor
{
    private $_questionType;
    
    public function __construct($dao, $sql, $questionType)
    {
        parent::__construct($dao, $sql);
        
        $this->_questionType = $questionType;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\QueryProcessor\QueryProcessor::process()
     */
    public function process()
    {
        $query = $this->dao()->prepare($this->sql());
        $query->bindValue(':questionType', $this->_questionType, \PDO::PARAM_STR);
        
        $query->execute();
        
        return $query;
    }
}

