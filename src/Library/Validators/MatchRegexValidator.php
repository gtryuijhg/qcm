<?php
namespace Aftral\Qcm\Library\Validators;

/**
 * 
 * @author gregoire.huteau
 *
 */
class MatchRegexValidator extends Validator
{
    private $_regex;
    
    public function __construct($errorMessage, $regex)
    {
        parent::__construct($errorMessage);
        
        $this->setRegex($regex);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Validators\Validator::isValid()
     */
    public function isValid(string $value):bool
    {
        return preg_match($this->_regex, $value);
    }
    
    /**
     * 
     * @param string/NULL $regex
     */
    public function setRegex($regex):void
    {
        if (is_string($regex))
        {
            $this->_regex = $regex;
        }
    }
}

