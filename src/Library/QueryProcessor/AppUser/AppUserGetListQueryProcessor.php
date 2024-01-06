<?php
namespace Aftral\Qcm\Library\QueryProcessor\AppUser;

use Aftral\Qcm\Library\QueryProcessor\QueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserGetListQueryProcessor extends QueryProcessor
{

    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\QueryProcessor\QueryProcessor::process()
     */
    public function process()
    {
        $query = $this->dao()->prepare($this->sql());
        $query->execute();
        
        return $query;
    }
}

