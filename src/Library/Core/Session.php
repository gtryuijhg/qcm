<?php
namespace Aftral\Qcm\Library\Core;

session_start();

/**
 * 
 * @author gregoire.huteau
 *
 */
class Session extends ApplicationComponent
{
    /**
     * 
     * @param mixed $attr
     * @return NULL|mixed
     */
    public function getAttribute($attr)
    {
        return isset($_SESSION[$attr]) ? $_SESSION[$attr] : NULL;
    }
    
    /**
     * 
     * @return boolean
     */
    public function isAuthenticated():bool
    {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === TRUE;
    }
    
    /**
     * 
     * @param string $attr
     * @param mixed $value
     */
    public function setAttribute($attr, $value):void
    {
        $_SESSION[$attr] = $value;
    }
    
    /**
     * 
     * @param boolean $authenticated
     * @throws \InvalidArgumentException
     */
    public function setAuthenticated($authenticated = TRUE):void
    {
        if (!is_bool($authenticated))
        {
            throw new \InvalidArgumentException('La valeur spécifiée à la méthose Session::setAuthenticated doit être un boolean');
        }
        
        $_SESSION['auth'] = $authenticated;
    }
    
    /**
     * make session empty
     */
    public function empty():void
    {
        $_SESSION = [];
    }
    
    /**
     * 
     * @return bool
     */
    public function hasFlashMessage():bool
    {
        return isset($_SESSION['flash']);
    }
    
    /**
     * 
     * @param string $value
     */
    public function setFlashMessage(string $value):void
    {
        $_SESSION['flash'] = htmlspecialchars($value);
    }
    
    /**
     * 
     * @return string
     */
    public function getFlashMessage():string
    {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        
        return $flash;
    }
    
    public function setFormToken():void
    {
        $_SESSION['formToken'] = htmlspecialchars(bin2hex(random_bytes(32)));
    }
    
    /**
     * 
     * @return string
     */
    public function getFormToken():string
    {
        return $_SESSION['formToken'];
    }
}

