<?php
namespace Aftral\Qcm\Library\Form;

/**
 * 
 * @author gregoire.huteau
 *
 */
class PassField extends Field
{

    private $_maxLength;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Form\Field::buildWidget()
     */
    public function buildWidget()
    {
        $widget = '';
        
        $widget .= '<div class="form-group"><label class="form-label">'.$this->label().'</label><input type="password" name="'.$this->name().'" class="form-control"';
        
        if (!empty($this->value()))
        {
            $widget .= ' value="'.htmlspecialchars($this->value()).'"';
        }
        
        if (!empty($this->_maxLength))
        {
            $widget .= ' maxLength="'.$this->_maxLength.'"/>';
        }
        
        if (!empty($this->errorMessage()))
        {
            $widget .= ' '.$this->errorMessage();
        }
        
        $widget .= '</div>';
        
        return $widget;
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

