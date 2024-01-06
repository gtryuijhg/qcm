<?php
namespace Aftral\Qcm\Library\Core;

/**
 * 
 * @author gregoire.huteau
 *
 */
class Page extends ApplicationComponent
{
    private $_contentFile;
    private $_vars = [];
    
    /**
     * 
     * @param string $var
     * @param mixed $value
     * @throws \InvalidArgumentException
     */
    public function addVar(string $var, $value)
    {
        if (!is_string($var) || is_numeric($var) || empty($var))
        {
            throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de cazractères non nulle');
        }
        
        $this->_vars[$var] = $value;
    }
    
    /**
     * 
     * @throws \RuntimeException
     * @return string
     */
    public function getGeneratedPage()
    {
        if (!file_exists($this->_contentFile))
        {
            throw new \RuntimeException('La vue spécifiée n\'existe pas');
        }
        
        $session = $this->app()->session();
        
        extract($this->_vars);
        
        ob_start();
            require_once $this->_contentFile;
        $content = ob_get_clean();
        
        ob_start();
            require_once __DIR__.'/../../Applications/'.$this->app()->name().'/Templates/layout.php';
        return ob_get_clean();
    }
    
    /**
     * 
     * @param string $contentFile
     * @throws \InvalidArgumentException
     */
    public function setContentFile(string $contentFile):void
    {
        if (empty($contentFile))
        {
            throw new \InvalidArgumentException('La vue spécifiée est invalide');
        }
        
        $this->_contentFile = $contentFile;
    }
}

