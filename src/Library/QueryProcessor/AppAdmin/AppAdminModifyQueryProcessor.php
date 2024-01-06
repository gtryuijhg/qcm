<?php
namespace Aftral\Qcm\Library\QueryProcessor\AppAdmin;

use Aftral\Qcm\Library\QueryProcessor\QueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminModifyQueryProcessor extends QueryProcessor
{
    private $_appAdmin;
    
    public function __construct($dao, $sql, $appAdmin)
    {
        parent::__construct($dao, $sql);
        
        $this->_appAdmin = $appAdmin;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\QueryProcessor\QueryProcessor::process()
     */
    public function process()
    {
        $query = $this->dao()->prepare($this->sql());
        $query->bindValue(':id', $this->_appAdmin->id(), \PDO::PARAM_INT);
        $query->bindValue(':appAdminPassword', $this->_appAdmin->appAdminPassword(), \PDO::PARAM_STR);
        
        $query->execute();
        $query->closeCursor();
    }
}

