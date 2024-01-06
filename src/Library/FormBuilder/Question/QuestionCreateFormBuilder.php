<?php
namespace Aftral\Qcm\Library\FormBuilder\Question;

use Aftral\Qcm\Library\Form\OptionField;
use Aftral\Qcm\Library\Form\SelectField;
use Aftral\Qcm\Library\Form\TextField;
use Aftral\Qcm\Library\FormBuilder\FormBuilder;
use Aftral\Qcm\Library\Validators\NotNullValidator;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionCreateFormBuilder extends FormBuilder
{

    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormBuilder\FormBuilder::build()
     */
    public function build()
    {
        $this->form()->add(new TextField([
            'label' => 'Question',
            'name' => 'questionBody',
            'cols' => 20,
            'rows' => 3,
            'validators' => [
                new NotNullValidator('Veuillez saisir une question')
            ]
        ]));
        
        $this->form()->add(new SelectField([
            'label' => 'Type de question',
            'name' => 'questionType',
            'options' => [
                new OptionField([
                    'value' => 'reception',
                    'text' => 'Réception'
                ]),
                new OptionField([
                    'value' => 'expedition',
                    'text' => 'Expédition'
                ]),
                new OptionField([
                    'value' => 'preparation',
                    'text' => 'Préparation de commandes'
                ]),
                new OptionField([
                    'value' => 'gestion',
                    'text' => 'Gestion de stocks'
                ])
            ]           
        ]));
        
        $this->form()->add(new SelectField([
            'label' => 'Nombre de solutions',
            'name' => 'solutionsNumber',
            'options' => [
                new OptionField([
                    'value' => '1',
                    'text' => '1'
                ]),
                new OptionField([
                    'value' => '2',
                    'text' => '2'
                ]),
                new OptionField([
                    'value' => '3',
                    'text' => '3'
                ])
            ]
        ]));
    }
}

