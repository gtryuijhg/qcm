<?php
namespace Aftral\Qcm\Library\QueryProcessor\AppUser;

use Aftral\Qcm\Library\QueryProcessor\QueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserDeleteQueryProcessor extends QueryProcessor
{
    private $_id;
    
    public function __construct($dao, $sql, $id)
    {
        parent::__construct($dao, $sql);
        
        $this->_id = $id;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\QueryProcessor\QueryProcessor::process()
     */
    public function process()
    {
        $query = $this->dao()->prepare($this->sql());
        $query->bindValue(':id', $this->_id, \PDO::PARAM_INT);
        
        $query->execute();
        $query->closeCursor();
    }
}

