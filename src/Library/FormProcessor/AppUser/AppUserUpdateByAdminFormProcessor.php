<?php
namespace Aftral\Qcm\Library\FormProcessor\AppUser;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\AppUser\AppUserForm\AppUserUpdateByAdminForm;
use Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase\AppUserDatabase;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserUpdateByAdminFormProcessor extends FormProcessor
{
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param AppUserUpdateByAdminForm $appUserUpdateByAdminForm
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AppUserUpdateByAdminForm $appUserUpdateByAdminForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($appUserUpdateByAdminForm);
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
                    //verifier mot de passe administrateur grace à son session id
                    $sessionAppAdmin = $this->dataFluxContainer()->session()->getAttribute('sessionAppAdmin');
                    
                    $adminInBase = $this->managers()->getManagerOf('AppAdmin')->searchById($sessionAppAdmin->id());
                    
                    if (password_verify($this->entity()->appAdminPassword(), $adminInBase->appAdminPassword()))
                    {
                        //verifier si deux nouveaux mots de passe utilisateur identiques
                        if ($this->entity()->newAppUserPassword() == $this->entity()->confirmNewAppUserPassword())
                        {
                            //on récupere l'utilisateur en fonction de son id
                            $userInBase = $this->managers()->getManagerOf('AppUser')->searchFullUserById($this->entity()->id());
                            
                            //on créée un objet utilisateur pour modification (avec l'id)
                            $newAppUser = new AppUserDatabase([
                                'id' => $this->entity()->id(),
                                'appUserFirstName' => $userInBase->appUserFirstName(),
                                'appUserLastName' => $userInBase->appUserLastName(),
                                'appUserLogin' => $userInBase->appUserLogin(),
                                'appUserPassword' => password_hash($this->entity()->newAppUserPassword(), PASSWORD_DEFAULT)
                            ]);
                            
                            //on sauvegarde l'utilisateur
                            $this->managers()->getManagerOf('AppUser')->save($newAppUser);
                            
                            $this->dataFluxContainer()->response()->redirect('/admins/admin/home');
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

