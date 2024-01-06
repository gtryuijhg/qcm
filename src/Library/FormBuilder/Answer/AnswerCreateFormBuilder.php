<?php
namespace Aftral\Qcm\Library\FormBuilder\Answer;

use Aftral\Qcm\Library\Entities\Answer\AnswerForm\AnswerCreateForm;
use Aftral\Qcm\Library\FormBuilder\FormBuilder;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\Form\TextField;
use Aftral\Qcm\Library\Form\SelectField;
use Aftral\Qcm\Library\Form\OptionField;
use Aftral\Qcm\Library\Form\HiddenField;
use Aftral\Qcm\Library\Validators\NotNullValidator;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerCreateFormBuilder extends FormBuilder
{
    private $_answer;
    
    public function __construct(AnswerCreateForm $answer)
    {
        $this->_answer = $answer;
        $this->setForm(new Form($this->_answer));
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
            'validators' => [
                new NotNullValidator('Veuillez saisir une réponse')
            ]
        ]));
        
        $this->form()->add(new SelectField([
            'label' => 'Solution à une question',
            'name' => 'isSolution',
            'options' => [
                new OptionField([
                    'value' => 'oui',
                    'text' => 'Oui'
                ]),
                new OptionField([
                    'value' => 'non',
                    'text' => 'Non'
                ])
            ]
        ]));
        
        $this->form()->add(new HiddenField([
            'name' => 'questionId',
            'value' => $this->_answer->questionId()
        ]));
    }
}

