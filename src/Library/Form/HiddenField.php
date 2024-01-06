<?php
namespace Aftral\Qcm\Library\Form;

/**
 * 
 * @author gregoire.huteau
 *
 */
class HiddenField extends Field
{
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Form\Field::buildWidget()
     */
    public function buildWidget()
    {
        $widget = '';
        
        $widget .= '<input type="hidden" name="'.$this->name().'"';
        
        if (!empty($this->value()))
        {
            $widget .= ' value="'.htmlspecialchars($this->value()).'"';
        }
        
        $widget .= '/>';
        
        return $widget;
    }
    
}

