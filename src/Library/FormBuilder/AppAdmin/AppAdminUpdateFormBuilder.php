<?php
namespace Aftral\Qcm\Library\FormBuilder\AppAdmin;

use Aftral\Qcm\Library\Form\PassField;
use Aftral\Qcm\Library\FormBuilder\FormBuilder;
use Aftral\Qcm\Library\Validators\NotNullValidator;
use Aftral\Qcm\Library\Validators\MinLengthValidator;
use Aftral\Qcm\Library\Validators\MaxLengthValidator;
use Aftral\Qcm\Library\Validators\MatchRegexValidator;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminUpdateFormBuilder extends FormBuilder
{
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormBuilder\FormBuilder::build()
     */
    public function build()
    {
        $this->form()->add(new PassField([
            'label' => 'Votre mot de passe',
            'name' => 'appAdminPassword',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Veuillez saisir votre mot de passe'),
                new MinLengthValidator('Ce mot de passe est trop court', 8),
                new MaxLengthValidator('Ce mot de passe est trop long', 20),
                new MatchRegexValidator('Veuillez saisir un mot de passe valide', '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#')
            ]
        ]));
        
        $this->form()->add(new PassField([
            'label' => 'Nouveau mot de passe',
            'name' => 'newAppAdminPassword',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Veuillez saisir un nouveau mot de passe'),
                new MinLengthValidator('Ce mot de passe est trop court', 8),
                new MaxLengthValidator('Ce mot de passe est trop long', 20),
                new MatchRegexValidator('Veuillez saisir un mot de passe valide', '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#')
            ]
        ]));
        
        $this->form()->add(new PassField([
            'label' => 'Confirmer le nouveau mot de passe',
            'name' => 'confirmNewAppAdminPassword',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Veuillez confirmer votre nouveau mot de passe'),
                new MinLengthValidator('Ce mot de passe est trop court', 8),
                new MaxLengthValidator('Ce mot de passe est trop long', 20),
                new MatchRegexValidator('Veuillez saisir un mot de passe valide', '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#')
            ]
        ]));
    }
}

