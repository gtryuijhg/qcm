<?php
namespace Aftral\Qcm\Library\Core;

/**
 * 
 * @author gregoire.huteau
 *
 */
class Router
{
    private $_routes = [];
    
    const NO_ROUTE = 1;
    
    /**
     * 
     * @param Route $route
     */
    public function addRoute(Route $route):void
    {
        if (!in_array($route, $this->_routes))
        {
            $this->_routes[] = $route;
        }
    }
    
    /**
     * 
     * @param string $url
     * @throws \RuntimeException
     * @return Route
     */
    public function getRoute(string $url):Route
    {
        foreach ($this->_routes as $route)
        {
            //si la route correspond à l'url
            if (($varsValues = $route->match($url)) !== FALSE)
            {
                //si elle a des variables
                if ($route->hasVars())
                {
                    $varsNames = $route->varsNames();
                    $listVars = [];
                    
                    //on créé un tableau
                    foreach ($varsValues as $key => $match)
                    {
                        //la première valeur contient entièrement la chaine
                        if ($key !== 0)
                        {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }
                    
                    //on assigne le tableau de variables à la route
                    $route->setVars($listVars);
                }
                
                return $route;
            }     
        }
        
        throw new \RuntimeException('Aucune route ne correspond à l\'url', self::NO_ROUTE);
    }
}

