<?php
namespace Aftral\Qcm\Library\Validators;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class Validator
{
    private $_errorMessage;
    
    /**
     * 
     * @param string $errorMessage
     */
    public function __construct(string $errorMessage)
    {
        $this->setErrorMessage($errorMessage);
    }
    
    /**
     * 
     * @param string $value
     * @return bool
     */
    abstract public function isValid(string $value):bool;
    
    /**
     * 
     * @param string $errorMessage
     */
    public function setErrorMessage(string $errorMessage):void
    {        
        $this->_errorMessage = $errorMessage;
    }
    
    /**
     * 
     * @return string
     */
    public function getErrorMessage():string
    {
        return $this->_errorMessage;
    }
}

