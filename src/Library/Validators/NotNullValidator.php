<?php
namespace Aftral\Qcm\Library\Validators;

/**
 * 
 * @author gregoire.huteau
 *
 */
class NotNullValidator extends Validator
{
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Validators\Validator::isValid()
     */
    public function isValid($value):bool
    {
        return $value != '';
    }
}

