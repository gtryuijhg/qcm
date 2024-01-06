<?php
namespace Aftral\Qcm\Library\Form;

/**
 * 
 * @author gregoire.huteau
 *
 */
class CheckBoxField extends Field
{

    public function buildWidget()
    {
        $widget = '';
        
        $widget .= '<span class="form-group"><input type="checkbox" name="'.$this->name().'" class="form-check-input"/> <label class="form-check-label">'.$this->label().'</label></span> ';
        
        return $widget;
    }
}

