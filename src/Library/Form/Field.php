<?php
namespace Aftral\Qcm\Library\Form;

use Aftral\Qcm\Library\Validators\Validator;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class Field
{
    private $_errorMessage;
    private $_label;
    private $_name;
    private $_validators = [];
    private $_value;
    
    /**
     * 
     * @param array $data
     */
    public function __construct(array $data)
    {
        if (!empty($data))
        {
            $this->hydrate($data);
        }
    }
    
    /**
     * 
     * @return string
     */
    abstract public function buildWidget();
    
    /**
     * 
     * @param array $data
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            
            if (is_callable([$this, $method]))
            {
                $this->$method($value);
            }
        }
    }
    
    /**
     * 
     * @return bool
     */
    public function isValid():bool
    {
        foreach ($this->_validators as $validator)
        {
            if (!$validator->isValid($this->_value))
            {
                $this->_errorMessage = $validator->getErrorMessage();
                return FALSE;
            }
        }
        
        return TRUE;
    }
    
    /**
     * 
     * @return string
     */
    public function label()
    {
        return $this->_label;
    }
    
    /**
     * 
     * @return string
     */
    public function name()
    {
        return $this->_name;
    }
    
    /**
     * 
     * @return array
     */
    public function validators():array
    {
        return $this->_validators;
    }
    
    /**
     * 
     * @return string
     */
    public function value()
    {
        return $this->_value;
    }
    
    /**
     * 
     * @return string
     */
    public function errorMessage()
    {
        return $this->_errorMessage;
    }
    
    /**
     * 
     * @param string $label
     */
    public function setLabel($label):void
    {
        if (is_string($label))
        {
            $this->_label = $label;
        }        
    }
    
    /**
     * 
     * @param string $name
     */
    public function setName($name):void
    {
        if (is_string($name))
        {
            $this->_name = $name;
        }       
    }
    
    /**
     * 
     * @param array $validators
     */
    public function setValidators(array $validators):void
    {
        foreach ($validators as $validator)
        {
            if ($validator instanceof Validator && !in_array($validator, $this->_validators))
            {
                $this->_validators[] = $validator;
            }
        }
    }
    
    /**
     * 
     * @param string $value
     */
    public function setValue($value):void
    {
        if (is_string($value))
        {
            $this->_value = $value;
        }
    }
}

