<?php
namespace Aftral\Qcm\Library\FormBuilder\AppAdmin;

use Aftral\Qcm\Library\Form\StringField;
use Aftral\Qcm\Library\Form\PassField;
use Aftral\Qcm\Library\FormBuilder\FormBuilder;
use Aftral\Qcm\Library\Validators\NotNullValidator;
use Aftral\Qcm\Library\Validators\MinLengthValidator;
use Aftral\Qcm\Library\Validators\MaxLengthValidator;
use Aftral\Qcm\Library\Validators\MatchRegexValidator;
use Aftral\Qcm\Library\Validators\NotMatchRegexValidator;


/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminRegisterFormBuilder extends FormBuilder
{
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormBuilder\FormBuilder::build()
     */
    public function build()
    {
        $this->form()->add(new StringField([
            'label' => 'Prénom',
            'name' => 'appAdminFirstName',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Veuillez saisir un prénom'),
                new MinLengthValidator('Ce prénom est trop court', 3),
                new MaxLengthValidator('Ce prénom est trop long', 15),
                new MatchRegexValidator('Veuillez saisir un prénom valide', '#^(?=.*[a-z])(?=.*[A-Z])#')
            ]
        ]));
        
        $this->form()->add(new StringField([
            'label' => 'Nom',
            'name' => 'appAdminLastName',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Veuillez saisir un nom'),
                new MinLengthValidator('Ce nom est trop court', 3),
                new MaxLengthValidator('Ce nom est trop long', 15),
                new MatchRegexValidator('Veuillez saisir un nom valide', '#^(?=.*[a-z])(?=.*[A-Z])#'),
                new NotMatchRegexValidator('Veuillez saisir un nom valide', '#^(?=.*[0-9])#')
            ]
        ]));
        
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
        
        $this->form()->add(new PassField([
            'label' => 'Confirmer le mot de passe',
            'name' => 'confirmAppAdminPassword',
            'maxLength' => 20,
            'validators' => [
                new NotNullValidator('Veuilez confirmer le mot de passe'),
                new MinLengthValidator('Ce mot de passe est trop court', 8),
                new MaxLengthValidator('Ce mot de passe est trop long', 20),
                new MatchRegexValidator('Veuillez saisir un mot de passe valide', '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#')
            ]
        ]));
    }
}

