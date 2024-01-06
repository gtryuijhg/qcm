<?php
namespace Aftral\Qcm\Library\EntitySearcher;

use Aftral\Qcm\Library\Core\HTTPRequest;
use Aftral\Qcm\Library\Core\HTTPResponse;
use Aftral\Qcm\Library\Core\Managers;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class EntitySearcher
{
    private $_request;
    private $_managers;
    private $_response;
    
    /**
     * 
     * @param HTTPRequest $request
     * @param Managers $managers
     * @param HTTPResponse $response
     */
    public function __construct(HTTPRequest $request, Managers $managers, HTTPResponse $response)
    {
        $this->setRequest($request);
        $this->setManagers($managers);
        $this->setResponse($response);
    }
    
    /**
     * 
     * @param Managers $managers
     */
    public function setManagers(Managers $managers):void
    {
        $this->_managers = $managers;
    }
    
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
     * @param HTTPResponse $response
     */
    public function setResponse(HTTPResponse $response):void
    {
        $this->_response = $response;
    }
    
    /**
     * 
     * @return Managers
     */
    public function managers():Managers
    {
        return $this->_managers;
    }
    
    /**
     * 
     * @return HTTPRequest
     */
    public function request():HTTPRequest
    {
        return $this->_request;
    }
    
    /**
     * 
     * @return HTTPResponse
     */
    public function response():HTTPResponse
    {
        return $this->_response;
    }
    
    abstract public function search();
}

