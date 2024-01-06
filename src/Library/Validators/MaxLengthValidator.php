<?php
namespace Aftral\Qcm\Library\Validators;

/**
 * 
 * @author gregoire.huteau
 *
 */
class MaxLengthValidator extends Validator
{

    private $_maxLength;
    
    /**
     * 
     * @param string $errorMessage
     * @param int $maxLength
     */
    public function __construct(string $errorMessage, int $maxLength)
    {
        parent::__construct($errorMessage);
        
        $this->setMaxLength($maxLength);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Validators\Validator::isValid()
     */
    public function isValid(string $value):bool
    {
        return strlen($value) <= $this->_maxLength;
    }
    
    /**
     * 
     * @param int $maxLength
     * @throws \RuntimeException
     */
    public function setMaxLength($maxLength):void
    {
        $maxLength = (int) $maxLength;
        
        if ($maxLength > 0)
        {
            $this->_maxLength = $maxLength;
        }
        else
        {
            throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
        }
    }
}

