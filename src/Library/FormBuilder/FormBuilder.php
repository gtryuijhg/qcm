<?php
namespace Aftral\Qcm\Library\FormBuilder;

use Aftral\Qcm\Library\Core\Entity;
use Aftral\Qcm\Library\Form\Form;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class FormBuilder
{
    private $_form;
    
    /**
     * 
     * @param Entity $entity
     */
    public function __construct(Entity $entity)
    {
        $this->setForm(new Form($entity));
    }
   
    abstract public function build();
    
    /**
     * 
     * @param Form $form
     */
    public function setForm(Form $form):void
    {
        $this->_form = $form;
    }
    
    /**
     * 
     * @return Form
     */
    public function form()
    {
        if (!empty($this->_form))
        {
            return $this->_form;
        }       
    }
}

