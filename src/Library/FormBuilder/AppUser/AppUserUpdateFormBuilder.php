<?php
namespace Aftral\Qcm\Library\FormBuilder\AppUser;

use Aftral\Qcm\Library\Form\PassField;
use Aftral\Qcm\Library\FormBuilder\FormBuilder;
use Aftral\Qcm\Library\Validators\NotNullValidator;
use Aftral\Qcm\Library\Validators\MinLengthValidator;
use Aftral\Qcm\Library\Validators\MaxLengthValidator;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserUpdateFormBuilder extends FormBuilder
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
            'name' => 'appUserPassword',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Veuillez saisir votre mot de passe')
            ]
        ]));
        
        $this->form()->add(new Passfield([
            'label' => 'Nouveau mot de passe',
            'name' => 'newAppUserPassword',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Veuillez saisir un nouveau mot de passe'),
                new MinLengthValidator('Ce mot de passe est trop court', 8),
                new MaxLengthValidator('Ce mot de passe est trop long', 20)
            ]
        ]));
        
        $this->form()->add(new PassField([
            'label' => 'Confirmer le nouveau mot de passe',
            'name' => 'confirmNewAppUserPassword',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Veuillez confirmer votre nouveau mot de passe')
            ]
        ]));
    }
}

