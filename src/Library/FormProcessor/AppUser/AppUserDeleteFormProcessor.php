<?php
namespace Aftral\Qcm\Library\FormProcessor\AppUser;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\AppUser;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;
use Aftral\Qcm\Library\Entities\AppUser\AppUserForm\AppUserDeleteForm;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserDeleteFormProcessor extends FormProcessor
{   
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param AppUser $appUser
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AppUserDeleteForm $appUserDeleteForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($appUserDeleteForm);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormProcessor\FormProcessor::process()
     */
    public function process()
    {
        if ($this->dataFluxContainer()->request()->method() == 'POST')
        {
            //on verifie que les token correspondent et que la requete provient du formulaire
            if ($this->dataFluxContainer()->tokenMatch() && $this->dataFluxContainer()->sourceRequest())
            {
                if ($this->form()->isValid())
                {
                    $sessionAppUser = $this->dataFluxContainer()->session()->getAttribute('sessionAppUser');
                    
                    //on recupere le mot de passe en base de l'utilisateur en session
                    $userInBase = $this->managers()->getManagerOf('AppUser')->searchPasswordById($sessionAppUser->id());
                    
                    //on verifie la concordance des mots de passe
                    if (password_verify($this->entity()->appUserPassword(), $userInBase->appUserPassword()))
                    {                                        
                        //on supprime l'utilisateur
                        $this->managers()->getManagerOf('AppUser')->delete($sessionAppUser->id());
                        
                        //on déconnecte l'utilisateur supprimé
                        $this->dataFluxContainer()->response()->redirect('/users/user/disconnect');
                    }
                    else
                    {
                        $this->dataFluxContainer()->session()->setFlashMessage('Veuillez saisir votre mot de passe');
                    }
                }
            }
            else
            {
                $this->dataFluxContainer()->session()->setFlashMessage('Formulaire corrompu ou mauvaise deestination');
            }
        }
    }
}

