<?php
namespace Aftral\Qcm\Library\Core;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class Application
{
    private $_httpRequest;
    private $_httpResponse;
    private $_name;
    private $_session;
    private $_config;
    
    public function __construct()
    {
        $this->_httpRequest = new HTTPRequest($this);
        $this->_httpResponse = new HTTPResponse($this);
        $this->_name = '';
        
        $this->_session = new Session($this);
        $this->_config = new Config($this);
    }
    
    public function getController()
    {
        //on recupere les routes
        $router = new Router();
        
        $xml = new \DomDocument();
        $xml->load(__DIR__.'/../../Applications/'.$this->_name.'/Config/routes.xml');
        
        $routes = $xml->getElementsByTagName('route');
        
        //on parcours les routes
        foreach ($routes as $route)
        {
            $vars = [];
            
            //on regarde si des variables sont présentes dans l'url
            if ($route->hasAttribute('vars'))
            {
                $vars = explode(',', $route->getAttribute('vars'));
            }
            
            //on ajoute la route au routeur
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
        }
        
        try 
        {
            //on recupere la route correspondante à l'url
            $matchedRoute = $router->getRoute($this->_httpRequest->requestURI());
        }
        catch (\RuntimeException $e)
        {
            //aucune route ne correspond, la page demandée n'existe pas
            if ($e->getCode() == Router::NO_ROUTE)
            {
                switch ($this->_name)
                {
                    case 'QcmAppAdmins':
                        $this->_httpResponse->redirect('/admins/admin/disconnect');
                        break;
                    
                    case 'QcmAppUsers':
                        $this->_httpResponse->redirect('/users/user/signin');
                        break;
                }
            }
        }
        
        //on ajoute les variables de l'url au tableau $_GET
        $_GET = array_merge($_GET, $matchedRoute->vars());
        
        //on instancie le controlleur
        $controllerClass = 'Aftral\\Qcm\\Applications\\'.$this->_name.'\\Modules\\'.$matchedRoute->module().'\\'.$matchedRoute->module().'Controller';
        
        return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
    }
    
    abstract public function run();
    
    /**
     * 
     * @return \Aftral\Qcm\Library\Core\HTTPRequest
     */
    public function httpRequest():HTTPRequest
    {
        return $this->_httpRequest;
    }
    
    /**
     * 
     * @return \Aftral\Qcm\Library\Core\HTTPResponse
     */
    public function httpResponse():HTTPResponse
    {
        return $this->_httpResponse;
    }
    
    /**
     * 
     * @return string name
     */
    public function name():string
    {
        return $this->_name;
    }
    
    /**
     * 
     * @return \Aftral\Qcm\Library\Core\Session
     */
    public function session():Session
    {
        return $this->_session;
    }
    
    /**
     * 
     * @return \Aftral\Qcm\Library\Core\Config
     */
    public function config():Config
    {
        return $this->_config;
    }
    
    /**
     * 
     * @param string $name
     */
    public function setName(string $name):void
    {
        $this->_name = $name;
    }
}

