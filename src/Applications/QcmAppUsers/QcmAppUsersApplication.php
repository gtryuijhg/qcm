<?php
namespace Aftral\Qcm\Applications\QcmAppUsers;

use Aftral\Qcm\Library\Core\Application;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QcmAppUsersApplication extends Application
{

    public function __construct()
    {
        parent::__construct();
        
        $this->setName('QcmAppUsers');
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Core\Application::run()
     */
    public function run()
    {
        $controller = $this->getController();
        $controller->execute();
        
        $this->httpResponse()->setPage($controller->page());
        $this->httpResponse()->send();
    }
}

