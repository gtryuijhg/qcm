<?php
namespace Aftral\Qcm\Library\Core;

/**
 * 
 * @author gregoire.huteau
 *
 */
class Config extends ApplicationComponent
{
    private $_vars = [];
    
    /**
     * 
     * @param string $var
     * @return mixed|NULL
     */
    public function get($var)
    {
        if (!$this->_vars)
        {
            $xml = new \DOMDocument();
            $xml->load(__DIR__.'/../../Applications/'.$this->app()->name().'/Config/app.xml');
            
            $elements = $xml->getElementsByTagName('define');
            
            foreach ($elements as $element)
            {
                $this->_vars[$element->getAttribute('var')] = $element->getAttribute('value');
            }
        }
        
        if (isset($this->_vars[$var]))
        {
            return $this->_vars[$var];
        }
        
        return NULL;
    }
}

