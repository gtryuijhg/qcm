<?php
namespace Aftral\Qcm\Library\Models;

use Aftral\Qcm\Library\Core\Manager;
use Aftral\Qcm\Library\Entities\AppUser;
use Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase\AppUserDatabase;
use Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase\AppUserLoginSearchDatabase;
use Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase\AppUserByNameSearchDatabase;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class AppUserManager extends Manager
{
    /**
     * 
     * @param AppUser $appUser
     */
    abstract protected function add(AppUserDatabase $appUser);
    
    /**
     * 
     * @param AppUser $appUser
     */
    public function save(AppUserDatabase $appUser)
    {
        $appUser->isNew() ? $this->add($appUser) : $this->modify($appUser);
    }
    
    /**
     * 
     * @param AppUser $appUser
     */
    abstract protected function modify(AppUserDatabase $appUser);
    
    /**
     * 
     * @param AppUser $appUser
     */
    abstract public function searchByFirstNameAndLastName(AppUserByNameSearchDatabase $appUser);
    
    /**
     * 
     * @param AppUserLoginSearchDatabase $appUser
     */
    abstract public function searchByLogin(AppUserLoginSearchDatabase $appUser);
    
    /**
     * 
     * @return array
     */
    abstract public function getUserList();
    
    /**
     * 
     * @param int $id
     */
    abstract public function searchPasswordById(int $id);
    
    /**
     * 
     * @param int id
     */
    abstract public function delete(int $id);
    
    /**
     * 
     * @param int $id
     */
    abstract public function searchUserById(int $id);
    
    /**
     * 
     * @param int $id
     */
    abstract public function searchFullUserById(int $id);
}

