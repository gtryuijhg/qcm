<?php
namespace Aftral\Qcm\Library\FormProcessor\AppUser;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase\AppUserDatabase;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;
use Aftral\Qcm\Library\Entities\AppUser\AppUserForm\AppUserUpdateForm;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserUpdateFormProcessor extends FormProcessor
{
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param AppUserUpdateForm $appUserUpdateForm
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AppUserUpdateForm $appUserUpdateForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($appUserUpdateForm);
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
                    
                    //on cherche le mot de passe en base de l'utilisateur en session
                    $userInBase = $this->managers()->getManagerOf('AppUser')->searchPasswordById($sessionAppUser->id());
                    
                    //on verifie si le mot de passe donnerai le hash récupéré en base
                    if (password_verify($this->entity()->appUserPassword(), $userInBase->appUserPassword()))
                    {
                        //on verifie si les deux nouveaux mots de passe sont identiques
                        if ($this->entity()->newAppUserPassword() == $this->entity()->confirmNewAppUserPassword())
                        {
                            //on récupere l'utilisateur en fonction de son id
                            $oldAppUser = $this->managers()->getManagerOf('AppUser')->searchFullUserById($sessionAppUser->id());
                            
                            //on crée un nouvel objet utilisateur a sauvegarder
                            $newAppUser = new AppUserDatabase([
                                'id' => $oldAppUser->id(),
                                'appUserFirstName' => $oldAppUser->appUserFirstName(),
                                'appUserLastName' => $oldAppUser->appUserLastName(),
                                'appUserLogin' => $oldAppUser->appUserLogin(),
                                'appUserPassword' => password_hash($this->entity()->appUserPassword(), PASSWORD_DEFAULT)
                            ]);
                            
                            //on sauvegarde le mot de passe modifié
                            $this->managers()->getManagerOf('AppUser')->save($newAppUser);
                            
                            $this->dataFluxContainer()->response()->redirect('/users/user/home');
                            
                        }
                        else
                        {
                            $this->dataFluxContainer()->session()->setFlashMessage('Le nouveau mot de passe et sa confirmation sont différents');
                        }
                    }
                    else
                    {
                        $this->dataFluxContainer()->session()->setFlashMessage('Veuillez saisir votre mot de passe');
                    }
                }
            }
            else
            {
                $this->dataFluxContainer()->session()->setFlashMessage('Formulaire corrompu ou mauvaise destination');
            }
        }
    }
}

