<?php
namespace Aftral\Qcm\Applications\QcmAppAdmins;

use Aftral\Qcm\Library\Core\Application;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QcmAppAdminsApplication extends Application
{

    public function __construct()
    {
        parent::__construct();
        
        $this->setName('QcmAppAdmins');
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

