<?php
namespace Aftral\Qcm\Library\EntitySearcher\AppUser;

use Aftral\Qcm\Library\EntitySearcher\EntitySearcher;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserSearcher extends EntitySearcher
{
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\EntitySearcher\EntitySearcher::search()
     */
    public function search()
    {
        $appUserInBase = $this->managers()->getManagerOf('AppUser')->searchUserById($this->request()->getData('id'));
        
        if (empty($appUserInBase))
        {
            $this->response()->redirect('/admins/user/list');
        }
    }
}

