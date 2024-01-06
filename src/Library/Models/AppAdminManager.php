<?php
namespace Aftral\Qcm\Library\Models;

use Aftral\Qcm\Library\Entities\AppAdmin;
use Aftral\Qcm\Library\Core\Manager;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminDatabase\AppAdminDatabase;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminDatabase\AppAdminLoginSearchDatabase;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminDatabase\AppAdminByNameSearchDatabase;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class AppAdminManager extends Manager
{
    /**
     * 
     * @param AppAdmin $appAdmin
     */
    abstract protected function add(AppAdminDatabase $appAdmin);
    
    /**
     * 
     * @param AppAdmin $appAdmin
     */
    abstract protected function modify(AppAdminDatabase $appAdmin);
    
    /**
     * 
     * @param AppAdmin $appAdmin
     */
    public function save(AppAdminDatabase $appAdmin)
    {          
        $appAdmin->isNew() ? $this->add($appAdmin) : $this->modify($appAdmin);        
    }
    
    /**
     * 
     * @param AppAdmin $appAdmin
     */
    abstract public function searchByLogin(AppAdminLoginSearchDatabase $appAdminLoginSearchDatabase);
    
    /**
     * 
     * @param AppAdmin $appAdmin
     */
    abstract public function searchByFirstNameAndLastName(AppAdminByNameSearchDatabase $appAdminByNameSearchDatabase);
    
    /**
     * 
     * @param int id
     */
    abstract public function delete(int $id);
    
    /**
     * 
     * @param int id
     */
    abstract public function searchById(int $id);
}

