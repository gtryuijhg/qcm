<?php
namespace Aftral\Qcm\Library\FormProcessor\AppUser;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase\AppUserLoginSearchDatabase;
use Aftral\Qcm\Library\Entities\AppUser\AppUserForm\AppUserSigninForm;
use Aftral\Qcm\Library\Entities\AppUser\AppUser;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserSigninFormProcessor extends FormProcessor
{
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param AppUserSigninForm $appUser
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AppUserSigninForm $appUserSigninForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($appUserSigninForm);
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
                    //on créée l'objet de recherches en base
                    $appUserLoginSearch = new AppUserLoginSearchDatabase([
                        'appUserLogin' => $this->entity()->appUserLogin()
                    ]);
                    
                    //on cherche un utilisateur en fonction du login
                    $appUserInBase = $this->managers()->getManagerOf('AppUser')->searchByLogin($appUserLoginSearch);
                    
                    //on verifie si on trouve l'identifiant et si le password entré en formulaire donnerai le hash de l'utilisateur en base
                    if (!empty($appUserInBase) && password_verify($this->entity()->appUserPassword(), $appUserInBase->appUserPassword()))
                    {
                        //si c'est le même, on connecte l'utilisateur en session
                        $sessionAppUser = new AppUser([
                            'id' => $appUserInBase->id(),
                            'appUserFirstName' => $appUserInBase->appUserFirstName(),
                            'appUserLastName' => $appUserInBase->appUserLastName()
                        ]);
                        
                        $this->dataFluxContainer()->session()->setAttribute('sessionAppUser', $sessionAppUser);
                        $this->dataFluxContainer()->session()->setAuthenticated(TRUE);
                        
                        $this->dataFluxContainer()->response()->redirect('/users/user/home');
                    }
                    else
                    {
                        $this->dataFluxContainer()->session()->setFlashMessage('L\'utilisateur n\'existe pas ou le mot de passe est invalide');
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

