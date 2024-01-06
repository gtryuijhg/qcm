<?php
namespace Aftral\Qcm\Library\Core;

/**
 * 
 * @author gregoire.huteau
 *
 */
class HTTPRequest extends ApplicationComponent
{
    /**
     * 
     * @param mixed $key
     * @return NULL|mixed
     */
    public function getData($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : NULL;
    }
    
    /**
     * 
     * @param mixed $key
     * @return mixed
     */
    public function getExists($key)
    {
        return isset($_GET[$key]);
    }
    
    /**
     * 
     * @param mixed $key
     * @return NULL|mixed
     */
    public function postData($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : NULL;
    }
    
    /**
     * 
     * @param mixed $key
     * @return mixed
     */
    public function postExists($key)
    {
        return isset($_POST[$key]);
    }
    
    /**
     * 
     * @return string
     */
    public function method():string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    
    /**
     * 
     * @return string
     */
    public function requestURI():string
    {
        return $_SERVER['REQUEST_URI'];
    }
    
    /**
     * 
     * @return string
     */
    public function httpReferer():string
    {
        return $_SERVER['HTTP_REFERER'];
    }
}

