<?php
namespace Aftral\Qcm\Library\FormProcessor\AppUser;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase\AppUserByNameSearchDatabase;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;
use Aftral\Qcm\Library\Entities\AppUser\AppUserForm\AppUserRegisterForm;
use Aftral\Qcm\Library\Entities\AppUser\AppUserDatabase\AppUserDatabase;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserRegisterFormProcessor extends FormProcessor
{   
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param AppUserRegisterForm $appUser
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AppUserRegisterForm $appUserRegisterForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($appUserRegisterForm);
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
            //on verifie que les token correspondent et que la requete proviet du formulaire
            if ($this->dataFluxContainer()->tokenMatch() && $this->dataFluxContainer()->sourceRequest())
            {
                if ($this->form()->isValid())
                {
                    if ($this->entity()->appUserPassword() == $this->entity()->confirmAppUserPassword())
                    {
                        //créer object recherche en base
                        $appUserByNameSearch = new AppUserByNameSearchDatabase([
                            'appUserFirstName' => $this->entity()->appUserFirstName(),
                            'appUserLastName' => $this->entity()->appUserLastName()
                        ]);
                        
                        $appUserInBase = $this->managers()->getManagerOf('AppUser')->searchByFirstNameAndLastName($appUserByNameSearch);
                        
                        if (empty($appUserInBase))
                        {
                            //on crée un objet a sauvegarder
                            $appUserDatabase = new AppUserDatabase([
                                'appUserFirstName' => $this->entity()->appUserFirstName(),
                                'appUserLastName' => $this->entity()->appUserLastName(),
                                'appUserLogin' => $this->entity()->appUserLogin(),
                                'appUserPassword' => password_hash($this->entity()->appUserPassword(), PASSWORD_DEFAULT)
                            ]);
                            
                            //on sauvegarde l'utilisateur
                            $this->managers()->getManagerOf('AppUser')->save($appUserDatabase);
                            
                            $this->dataFluxContainer()->response()->redirect('/admins/admin/home');
                        }
                        else
                        {
                            $this->dataFluxContainer()->session()->setFlashMessage('Cet utilisateur existe déjà');
                        }
                    }
                    else
                    {
                        $this->dataFluxContainer()->session()->setFlashMessage('Le mot de passe et sa confirmation sont diffétents');
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

