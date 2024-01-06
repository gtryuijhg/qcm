<?php
namespace Aftral\Qcm\Library\FormBuilder\AppAdmin;

use Aftral\Qcm\Library\Form\PassField;
use Aftral\Qcm\Library\Form\StringField;
use Aftral\Qcm\Library\FormBuilder\FormBuilder;
use Aftral\Qcm\Library\Validators\MaxLengthValidator;
use Aftral\Qcm\Library\Validators\MinLengthValidator;
use Aftral\Qcm\Library\Validators\NotNullValidator;
use Aftral\Qcm\Library\Validators\MatchRegexValidator;
use Aftral\Qcm\Library\Validators\NotMatchRegexValidator;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminSigninFormBuilder extends FormBuilder
{
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormBuilder\FormBuilder::build()
     */
    public function build()
    {
        
        $this->form()->add(new StringField([
            'label' => 'Identifiant',
            'name' => 'appAdminLogin',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Veuillez saisir un identifiant'),
                new MinLengthValidator('Cet identifiant est trop court', 5),
                new MaxLengthValidator('Cet identifiant est trop long', 15),
                new NotMatchRegexValidator('Votre identifiant ne peut contenir que des lettres', '#^(?=.*[0-9])(?=.*\W)#')
            ]
        ]));
        
        $this->form()->add(new PassField([
            'label' => 'Mot de passe',
            'name' => 'appAdminPassword',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Veuillez saisir un mot de passe'),
                new MinLengthValidator('Ce mot de passe est trop court', 8),
                new MaxLengthValidator('Ce mot de passe est trop long', 20),
                new MatchRegexValidator('Veuillez saisir un mot de passe valide', '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#')
            ]
        ]));
    }
}

