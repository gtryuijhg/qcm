<?php
namespace Aftral\Qcm\Library\QueryProcessor\AppUser;

use Aftral\Qcm\Library\QueryProcessor\QueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserSigninQueryProcessor extends QueryProcessor
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
        $query->bindValue(':appUserLogin', $this->_appUser->appUserLogin(), \PDO::PARAM_STR);
        
        $query->execute();
        
        return $query;
    }
}

