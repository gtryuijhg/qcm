<?php
namespace Aftral\Qcm\Library\Core;

/**
 * 
 * @author gregoire.huteau
 *
 */
class Route
{
    private $_action;
    private $_module;
    private $_url;
    private $_varsNames;
    private $_vars = [];
    
    /**
     * 
     * @param string $url
     * @param string $module
     * @param string $action
     * @param array $varsNames
     */
    public function __construct(string $url, string $module, string $action, array $varsNames)
    {
        $this->setUrl($url);
        $this->setModule($module);
        $this->setAction($action);
        $this->setVarsNames($varsNames);
    }
    
    /**
     * 
     * @return boolean
     */
    public function hasVars():bool
    {
        return !empty($this->_varsNames);
    }
    
    /**
     * 
     * @param string $url
     * @return string|boolean
     */
    public function match(string $url)
    {
        if (preg_match('#^'.$this->_url.'$#', $url, $matches))
        {
            return $matches;
        }
        
        return FALSE;
    }
    
    /**
     * 
     * @param string $action
     */
    public function setAction(string $action):void
    {
        $this->_action = $action;
    }
    
    /**
     * 
     * @param string $module
     */
    public function setModule(string $module):void
    {
        $this->_module = $module;
    }
    
    /**
     * 
     * @param string $url
     */
    public function setUrl(string $url):void
    {
        $this->_url = $url;
    }
    
    /**
     * 
     * @param array $varsNames
     */
    public function setVarsNames(array $varsNames):void
    {
        $this->_varsNames = $varsNames;
    }
    
    /**
     * 
     * @param array $vars
     */
    public function setVars(array $vars):void
    {
        $this->_vars = $vars;
    }
    
    /**
     * 
     * @return string action
     */
    public function action():string
    {
        return $this->_action;
    }
    
    /**
     * 
     * @return string module
     */
    public function module():string
    {
        return $this->_module;
    }
    
    /**
     * 
     * @return array vars
     */
    public function vars():array
    {
        return $this->_vars;
    }
    
    /**
     * 
     * @return array varsNames
     */
    public function varsNames():array
    {
        return $this->_varsNames;
    }
}

