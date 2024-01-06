<?php
namespace Aftral\Qcm\Library\Models;

use Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase\AppUserDatabase;
use Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase\AppUserLoginSearchDatabase;
use Aftral\Qcm\Library\QueryProcessor\AppUser\AppUserDeleteQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppUser\AppUserGetListQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppUser\AppUserInsertQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppUser\AppUserModifyQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppUser\AppUserSearchByNameQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppUser\AppUserSearchFullUserByIdQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppUser\AppUserSearchPasswordByIdQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppUser\AppUserSearchUserByIdQueryProcessor;
use Aftral\Qcm\Library\QueryProcessor\AppUser\AppUserSigninQueryProcessor;
use Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase\AppUserByNameSearchDatabase;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserManagerPDO extends AppUserManager
{
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppUserManager::add()
     */
    protected function add(AppUserDatabase $appUser)
    {
        $sql = 'INSERT INTO app_users (appUserFirstName, appUserLastName, appUserLogin, appUserPassword) VALUES (:appUserFirstName, :appUserLastName, :appUserLogin, :appUserPassword)';
        
        $queryProcessor = new AppUserInsertQueryProcessor($this->dao(), $sql, $appUser);
        $queryProcessor->process();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppUserManager::searchByFirstNameAndLastName()
     */
    public function searchByFirstNameAndLastName(AppUserByNameSearchDatabase $appUser)
    {        
        $sql = 'SELECT id, appUserFirstName, appUserLastName, appUserLogin, appUserPassword FROM app_users WHERE appUserFirstName = :appUserFirstName AND appUserLastName = :appUserLastName';
        
        $queryProcessor = new AppUserSearchByNameQueryProcessor($this->dao(), $sql, $appUser);
        $query = $queryProcessor->process();
        
        if ($appUserInBase = $query->fetch())
        {
            $appUserInBase = new AppUserDatabase($appUserInBase);
            
            $query->closeCursor();
            
            return $appUserInBase;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppUserManager::searchByLogin()
     */
    public function searchByLogin(AppUserLoginSearchDatabase $appUser)
    {
        $sql = 'SELECT id, appUserFirstName, appUserLastName, appUserLogin, appUserPassword FROM app_users WHERE appUserLogin = :appUserLogin';
        
        $queryProcessor = new AppUserSigninQueryProcessor($this->dao(), $sql, $appUser);
        $query = $queryProcessor->process();
        
        //si on trouve l'utilisateur
        if ($appUserInBase = $query->fetch())
        {         
            $appUserInBase = new AppUserDatabase($appUserInBase);
            
            $query->closeCursor();
            
            return $appUserInBase;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppUserManager::getUserList()
     */
    public function getUserList()
    {       
        $sql = 'SELECT id, appUserFirstName, appUserLastName FROM app_users';
        
        $queryProcessor = new AppUserGetListQueryProcessor($this->dao(), $sql);
        $query = $queryProcessor->process();
        
        //on liste les resultats
        if ($appUserList = $query->fetchAll())
        {
            $query->closeCursor();
            
            return $appUserList;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppUserManager::searchPasswordById()
     */
    public function searchPasswordById(int $id)
    {
        $sql = 'SELECT appUserPassword FROM app_users WHERE id = :id';
        
        $queryProcessor = new AppUserSearchPasswordByIdQueryProcessor($this->dao(), $sql, $id);
        $query = $queryProcessor->process();
        
        if ($appUserInBase = $query->fetch())
        {
            $appUserInBase = new AppUserDatabase($appUserInBase);
            
            $query->closeCursor();
            
            return $appUserInBase;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppUserManager::modify()
     */
    protected function modify(AppUserDatabase $appUser)
    {       
        $sql = 'UPDATE app_users SET appUserFirstName = :appUserFirstName, appUserLastName = :appUserLastName, appUserLogin = :appUserLogin, appUserPassword = :appUserPassword WHERE id = :id';
        
        $queryProcessor = new AppUserModifyQueryProcessor($this->dao(), $sql, $appUser);
        $queryProcessor->process();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppUserManager::delete()
     */
    public function delete(int $id)
    {        
        $sql = 'DELETE FROM app_users WHERE id = :id';
        
        $queryProcessor = new AppUserDeleteQueryProcessor($this->dao(), $sql, $id);
        $queryProcessor->process();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppUserManager::searchUserById()
     */
    public function searchUserById(int $id)
    {
        $sql = 'SELECT id, appUserFirstName, appUserLastName FROM app_users WHERE id = :id';
        
        $queryProcessor = new AppUserSearchUserByIdQueryProcessor($this->dao(), $sql, $id);
        $query = $queryProcessor->process();
        
        //si on trouve l'utilisateur
        if ($appUserInBase = $query->fetch())
        {
            $appUserInBase = new AppUserDatabase($appUserInBase);
            
            $query->closeCursor();
            
            return $appUserInBase;
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Models\AppUserManager::searchFullUserById()
     */
    public function searchFullUserById(int $id)
    {
        $sql = 'SELECT id, appUserFirstName, appUserLastName, appUserLogin, appUserPassword FROM app_users WHERE id = :id';
        
        $queryProcessor = new AppUserSearchFullUserByIdQueryProcessor($this->dao(), $sql, $id);
        $query = $queryProcessor->process();
        
        //si on trouve l'utilisateur
        if ($appUserInBase = $query->fetch())
        {
            $appUserInBase = new AppUserDatabase($appUserInBase);
            
            $query->closeCursor();
            
            return $appUserInBase;
        }
    }

}

