<?php
namespace Aftral\Qcm\Library\Core;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class ApplicationComponent
{
    private $_app;
    
    /**
     * 
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->_app = $app;
    }
    
    /**
     * 
     * @return \Aftral\Qcm\Library\Core\Application
     */
    public function app():Application
    {
        return $this->_app;
    }
}

