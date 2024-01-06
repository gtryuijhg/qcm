<?php
namespace Aftral\Qcm\Library\QueryProcessor\AppUser;

use Aftral\Qcm\Library\QueryProcessor\QueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserSearchByNameQueryProcessor extends QueryProcessor
{
    private $_appUser;
    
    public function __construct($dao, $sql, $appUser)
    {
        parent::__construct($dao, $sql);
        
        $this->_appUser = $appUser;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\QueryProcessor\QueryProcessor::process()
     */
    public function process()
    {
        $query = $this->dao()->prepare($this->sql());
        
        $query->bindValue(':appUserFirstName', $this->_appUser->appUserFirstName(), \PDO::PARAM_STR);
        $query->bindValue(':appUserLastName', $this->_appUser->appUserLastName(), \PDO::PARAM_STR);
        
        $query->execute();
        
        return $query;
    }
}

