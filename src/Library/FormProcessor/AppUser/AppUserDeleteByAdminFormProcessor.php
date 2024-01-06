<?php
namespace Aftral\Qcm\Library\FormProcessor\AppUser;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\AppUser;
use Aftral\Qcm\Library\Entities\AppUser\AppUserForm\AppUserDeleteByAdminForm;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppUserDeleteByAdminFormProcessor extends FormProcessor
{
    
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param AppUser $appUser
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AppUserDeleteByAdminForm $appUserDeleteByAdminForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($appUserDeleteByAdminForm);
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
                    
                    $adminInBase = $this->managers()->getManagerOf('AppAdmin')->searchPasswordById($sessionAppAdmin->id());
                    
                    //on verifie la concordance des mots de passe en base
                    if (password_verify($this->entity()->appAdminPassword(), $adminInBase->appAdminPassword()))
                    {
                        //on supprime l'utilisateur en fonction de son id
                        $this->managers()->getManagerOf('AppUser')->delete($this->entity()->id());
                        
                        $this->dataFluxContainer()->response()->redirect('/admins/admin/home');                    
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

