<?php
namespace Aftral\Qcm\Library\Models;

use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminDatabase\AppAdminByNameSearchDatabase;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminDatabase\AppAdminDatabase;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminDatabase\AppAdminLoginSearchDatabase;
use Aftral\Qcm\Library\QueryProcessor\AppAdmin\AppAdminDeleteQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppAdmin\AppAdminInsertQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppAdmin\AppAdminModifyQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppAdmin\AppAdminSearchByNameQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppAdmin\AppAdminSearchByIdQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppAdmin\AppAdminSigninQueryProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminManagerPDO extends AppAdminManager
{

    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppAdminManager::add()
     */
    protected function add(AppAdminDatabase $appAdminDatabase)
    {
        $sql = 'INSERT INTO app_admins (appAdminFirstName, appAdminLastName, appAdminLogin, appAdminPassword) VALUES (:appAdminFirstName, :appAdminLastName, :appAdminLogin, :appAdminPassword)';
       
        $queryProcessor = new AppAdminInsertQueryProcessor($this->dao(), $sql, $appAdminDatabase);
        $queryProcessor->process();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppAdminManager::modify()
     */
    protected function modify(AppAdminDatabase $appAdminDatabase)
    {           
        $sql = 'UPDATE app_admins SET appAdminPassword = :appAdminPassword WHERE id = :id';
        
        $queryProcessor = new AppAdminModifyQueryProcessor($this->dao(), $sql, $appAdminDatabase);
        $queryProcessor->process();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppAdminManager::searchByLogin()
     */
    public function searchByLogin(AppAdminLoginSearchDatabase $appAdminLoginSearchDatabase)
    {
        $sql = 'SELECT id, appAdminFirstName, appAdminLastName, appAdminLogin, appAdminPassword FROM app_admins WHERE appAdminLogin = :appAdminLogin';
        
        $queryProcessor = new AppAdminSigninQueryProcessor($this->dao(), $sql, $appAdminLoginSearchDatabase);
        $query = $queryProcessor->process();
        
        //si on trouve l'administrateur
        if ($appAdminInBase = $query->fetch())
        {
            $appAdminInBase = new AppAdminDatabase($appAdminInBase);
        }
                
        $query->closeCursor();
        
        return $appAdminInBase;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppAdminManager::searchByFirstNameAndLastName()
     */
    public function searchByFirstNameAndLastName(AppAdminByNameSearchDatabase $appAdminByNameSearchDatabase)
    {       
        $sql = 'SELECT id, appAdminFirstName, appAdminLastName, appAdminLogin, appAdminPassword FROM app_admins WHERE appAdminFirstName = :appAdminFirstName AND appAdminLastName = :appAdminLastName';
        
        $queryProcessor = new AppAdminSearchByNameQueryProcessor($this->dao(), $sql, $appAdminByNameSearchDatabase);
        $query = $queryProcessor->process();
        
        if ($appAdminInBase = $query->fetch())
        {
            $appAdminInBase = new AppAdminDatabase($appAdminInBase);
        }
        
        $query->closeCursor();
            
        return $appAdminInBase;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppAdminManager::delete()
     */
    public function delete(int $id)
    {
        $sql = 'DELETE FROM app_admins WHERE id = :id';
        $queryProcessor = new AppAdminDeleteQueryProcessor($this->dao(), $sql, $id);
        $queryProcessor->process();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppAdminManager::searchById()
     */
    public function searchById(int $id)
    {
        $sql = 'SELECT id, appAdminFirstName, appAdminLastName, appAdminLogin, appAdminPassword FROM app_admins WHERE id = :id';
        
        $queryProcessor = new AppAdminSearchByIdQueryProcessor($this->dao(), $sql, $id);
        $query = $queryProcessor->process();
        
        $adminInBase = new AppAdminDatabase($query->fetch());
        
        $query->closeCursor();
        
        return $adminInBase;
    }
}

