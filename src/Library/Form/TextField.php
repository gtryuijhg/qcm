<?php
namespace Aftral\Qcm\Library\Form;

/**
 * 
 * @author gregoire.huteau
 *
 */
class TextField extends Field
{
    private $_cols;
    private $_rows;
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\Form\Field::buildWidget()
     */
    public function buildWidget()
    {
        $widget = '';
        
        $widget = '<label class="form-label">'.$this->label().'</label><textarea name="'.$this->name().'" class="form-control"';
        
        if (!empty($this->_cols))
        {
            $widget .= ' cols="'.$this->_cols.'"';
        }
        
        if (!empty($this->_rows))
        {
            $widget .= ' rows="'.$this->_rows.'"';
        }
        
        $widget .= '>';
        
        if (!empty($this->value()))
        {
            $widget .= htmlspecialchars($this->value());
        }
        
        $widget.='</textarea>';
        
        if (!empty($this->errorMessage()))
        {
            $widget .= ' '.$this->errorMessage();
        }
        
        return $widget;
    }
    
    /**
     * 
     * @param int $rows
     */
    public function setRows($rows):void
    {
        $rows = (int) $rows;
        
        if ($rows > 0)
        {
            $this->_rows = $rows;
        }
    }
    
    /**
     * 
     * @param int $cols
     */
    public function setCols($cols):void
    {
        $cols = (int) $cols;
        
        if ($cols > 0)
        {
            $this->_cols = $cols;
        }
    }
}

