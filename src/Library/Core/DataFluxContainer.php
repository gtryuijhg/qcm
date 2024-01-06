<?php
namespace Aftral\Qcm\Library\Core;

/**
 * 
 * @author gregoire.huteau
 *
 */
class DataFluxContainer
{
    private $_request;
    private $_session;
    private $_response;
    
    /**
     * 
     * @param HTTPRequest $request
     * @param Session $session
     * @param HTTPResponse $response
     */
    public function __construct(HTTPRequest $request, Session $session, HTTPResponse $response)
    {
        $this->setRequest($request);
        $this->setSession($session);
        $this->setResponse($response);
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
     * @param Session $session
     */
    public function setSession(Session $session):void
    {
        $this->_session = $session;
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
     * @return HTTPRequest
     */
    public function request():HTTPRequest
    {
        return $this->_request;
    }
    
    /**
     * 
     * @return Session
     */
    public function session():Session
    {
        return $this->_session;
    }
    
    /**
     * 
     * @return HTTPResponse
     */
    public function response():HTTPResponse
    {
        return $this->_response;
    }
    
    /**
     * 
     * @return boolean
     */
    public function tokenMatch()
    {
        return $this->_session->getFormToken() == $this->_request->postData('formToken');
    }
    
    /**
     * 
     * @return boolean
     */
    public function sourceRequest()
    {
        return $this->_request->httpReferer() == 'http://localhost:8080'.$this->_request->requestURI();
    }
}

