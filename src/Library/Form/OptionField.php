<?php
namespace Aftral\Qcm\Library\Form;

class OptionField extends Field
{
    private $_text;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Form\Field::buildWidget()
     */
    public function buildWidget()
    {
        $widget = '';
        
        $widget .= '<option value="'.$this->value().'">'.$this->text().'</option>';
        
        return $widget;
    }
    
    /**
     * 
     * @param string $text
     */
    public function setText($text):void
    {
        if (is_string($text))
        {
            $this->_text = $text;
        }
    }
    
    /**
     * 
     * @return string
     */
    public function text()
    {
        return $this->_text;
    }
}

