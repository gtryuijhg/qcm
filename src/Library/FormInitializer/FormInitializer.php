<?php
namespace Aftral\Qcm\Library\FormInitializer;

use Aftral\Qcm\Library\Core\HTTPRequest;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class FormInitializer
{
    private $_request;
    
    /**
     * 
     * @param HTTPRequest $request
     */
    public function __construct(HTTPRequest $request)
    {
        $this->setRequest($request);
    }
    
    abstract public function initialize();
    
    /**
     * 
     * @param HTTPRequest $request
     */
    public function setRequest(HTTPRequest $request):void
    {
        $this->_request = $request;
    }
    
    /**
     * 
     * @return HTTPRequest
     */
    public function request():HTTPRequest
    {
        return $this->_request;
    }
}

