<?php
namespace Aftral\Qcm\Library\FormBuilder\Answer;

use Aftral\Qcm\Library\FormBuilder\FormBuilder;
use Aftral\Qcm\Library\Form\PassField;
use Aftral\Qcm\Library\Validators\NotNullValidator;
use Aftral\Qcm\Library\Validators\MatchRegexValidator;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerDeleteFormBuilder extends FormBuilder
{
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormBuilder\FormBuilder::build()
     */
    public function build()
    {
        $this->form()->add(new PassField([
            'label' => 'Mot de passe',
            'name' => 'appAdminPassword',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Veuillez saisir un mot de passe'),
                new MatchRegexValidator('Veuillez saisir un mot de passe valide', '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#'),
            ]
        ]));
    }
}

