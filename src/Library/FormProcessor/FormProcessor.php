<?php
namespace Aftral\Qcm\Library\FormProcessor;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Entity;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Form\Form;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class FormProcessor
{
    private $_dataFluxContainer;
    private $_form;
    private $_managers;
    private $_entity;
    
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     */
    public function __construct($form, Managers $managers, DataFluxContainer $dataFluxContainer)
    {
        $this->setDataFluxContainer($dataFluxContainer);
        $this->setForm($form);
        $this->setManagers($managers);
        
        $this->_entity = null;
    }
    
    abstract public function process();
    
    public function setEntity(Entity $entity)
    {
        if ($entity instanceof Entity)
        {
            $this->_entity = $entity;
        }
    }
    
    /**
     * 
     * @param DataFluxContainer $dataFluxContainer
     */
    public function setDataFluxContainer(DataFluxContainer $dataFluxContainer)
    {
        $this->_dataFluxContainer = $dataFluxContainer;
    }
    
    /**
     * 
     * @param Form $form
     */
    public function setForm($form)
    {
        $this->_form = $form;
    }
    
    /**
     * 
     * @param Managers $managers
     */
    public function setManagers(Managers $managers)
    {
        $this->_managers = $managers;
    }
    
    /**
     * 
     * @return DataFluxContainer
     */
    public function dataFluxContainer():DataFluxContainer
    {
        return $this->_dataFluxContainer;
    }
    
    /**
     * 
     * @return NULL|Entity
     */
    public function entity():Entity
    {
        return $this->_entity;
    }
    
    /**
     * 
     * @return Form
     */
    public function form():Form
    {
        return $this->_form;
    }
    
    /**
     * 
     * @return Managers
     */
    public function managers():Managers
    {
        return $this->_managers;
    }
}

