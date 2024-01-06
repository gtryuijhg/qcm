<?php
namespace Aftral\Qcm\Library\Form;

use Aftral\Qcm\Library\Core\Entity;

/**
 * 
 * @author gregoire.huteau
 *
 */
class Form
{
    protected $_entity;
    protected $_fields;
    
    /**
     * 
     * @param Entity $entity
     */
    public function __construct(Entity $entity)
    {
        $this->setEntity($entity);
    }
    
    /**
     * 
     * @param Field $field
     * @return Field
     */
    public function add(Field $field)
    {
        $attr = $field->name();//on recupere le nom du champ
        $field->setValue($this->_entity->$attr());//on assigne la valeur correspondante au champ
        
        $this->_fields[] = $field;//on ajoute le champ à la liste
        
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function createView()
    {
        $view = '';
              
        //on génère un par un les champs du formulaire
        foreach ($this->_fields as $field)
        {
            $view .= $field->buildWidget();
        }
        
        return $view;
   
    }
    
    /**
     * 
     * @return bool
     */
    public function isValid()
    {
        $valid = TRUE;
        
        //on vérifie que tous les champs sont valides
        foreach ($this->_fields as $field)
        {
            if (!$field->isValid())
            {
                $valid = FALSE;
            }
        }
        
        return $valid;
    }
    
    /**
     * 
     * @return Entity
     */
    public function entity()
    {
        return $this->_entity;
    }
    
    /**
     * 
     * @param Entity $entity
     */
    public function setEntity(Entity $entity):void
    {
        $this->_entity = $entity;
    }
}

