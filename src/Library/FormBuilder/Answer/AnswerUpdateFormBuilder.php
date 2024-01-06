<?php
namespace Aftral\Qcm\Library\FormBuilder\Answer;

use Aftral\Qcm\Library\Form\HiddenField;
use Aftral\Qcm\Library\Form\TextField;
use Aftral\Qcm\Library\FormBuilder\FormBuilder;
use Aftral\Qcm\Library\Validators\NotNullValidator;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerUpdateFormBuilder extends FormBuilder
{
    private $_answer;
    
    public function __construct($entity)
    {
        parent::__construct($entity);
        
        $this->_answer = $entity;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormBuilder\FormBuilder::build()
     */
    public function build()
    {
        $this->form()->add(new TextField([
            'label' => 'Réponse',
            'name' => 'answerBody',
            'cols' => 20,
            'rows' => 3,
            'value' => $this->_answer->answerBody(),
            'validators' => [
                new NotNullValidator('Veuillez saisir une réponse')
            ]
        ]));
        
        $this->form()->add(new HiddenField([
            'name' => 'questionId',
            'value' => $this->_answer->questionId()
        ]));
    }
}

