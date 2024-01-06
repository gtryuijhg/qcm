<?php
namespace Aftral\Qcm\Library\Validators;

/**
 * 
 * @author gregoire.huteau
 *
 */
class MinLengthValidator extends Validator
{

    private $_minLength;
    
    /**
     * 
     * @param string $errorMessage
     * @param int $minLength
     */
    public function __construct(string $errorMessage, int $minLength)
    {
        parent::__construct($errorMessage);
        
        $this->setMinLength($minLength);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Validators\Validator::isValid()
     */
    public function isValid(string $value):bool
    {
        return strlen($value) >= $this->_minLength;
    }
    
    /**
     * 
     * @param int $minLength
     * @throws \RuntimeException
     */
    public function setMinLength($minLength):void
    {
        $minLength = (int) $minLength;
        
        if ($minLength > 0)
        {
            $this->_minLength = $minLength;
        }
        else
        {
            throw new \RuntimeException('La longueur minimale doit être un nombre supérieur à 0');
        }
    }
}

