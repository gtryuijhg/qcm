<?php
namespace Aftral\Qcm\Library\Form;

/**
 * 
 * @author gregoire.huteau
 *
 */
class SelectField extends Field
{
    private $_options = [];
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Form\Field::buildWidget()
     */
    public function buildWidget()
    {
        $widget = '';
        
        $widget .= '<label class="form-label">'.$this->label().'</label><select name="'.$this->name().'" class="form-select">';
        
        foreach ($this->_options as $option)
        {
            $widget .= $option->buildWidget();
        }
        
        $widget .= '</select>';
        
        return $widget;
    }
    
    public function setOptions(array $options):void
    {
        foreach ($options as $option)
        {
            if ($option instanceof OptionField && !in_array($option, $this->_options))
            {
                $this->_options[] = $option;
            }
        }
    }
}

