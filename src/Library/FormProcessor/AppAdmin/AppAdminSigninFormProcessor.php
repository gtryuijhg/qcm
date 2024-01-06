<?php
namespace Aftral\Qcm\Library\FormProcessor\AppAdmin;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdmin;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminDatabase\AppAdminLoginSearchDatabase;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminForm\AppAdminSigninForm;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminSigninFormProcessor extends FormProcessor
{
       
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param AppAdminSigninForm $appAdminSigninForm
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AppAdminSigninForm $appAdminSigninForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($appAdminSigninForm);
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
                    //creer objet avec necessaire pour chercher administrateur en base puis passer l'objet a la methode de recherches
                    $appAdminLoginSearch = new AppAdminLoginSearchDatabase([
                        'appAdminLogin' => $this->entity()->appAdminLogin()        
                    ]);
                    
                    //on cherche un administrateur en fonction du login
                    $appAdminInBase = $this->managers()->getManagerOf('AppAdmin')->searchByLogin($appAdminLoginSearch);
                    
                    //on verifie si on trouve l'identifiant et si le password entré en formulaire donnerai le hash de l'administrateur en base
                    if (!empty($appAdminInBase) && password_verify($this->entity()->appAdminPassword(), $appAdminInBase->appAdminPassword()))
                    {
                        //si c'est le même, on connecte l'administrateur en session
                        $sessionAppAdmin = new AppAdmin([
                            'id' => $appAdminInBase->id(),
                            'appAdminFirstName' => $appAdminInBase->appAdminFirstName(),
                            'appAdminLastName' => $appAdminInBase->appAdminLastName()
                        ]);
                        
                        $this->dataFluxContainer()->session()->setAttribute('sessionAppAdmin', $sessionAppAdmin);
                        $this->dataFluxContainer()->session()->setAuthenticated(TRUE);
                        
                        $this->dataFluxContainer()->response()->redirect('/admins/admin/home');
                    }
                    else
                    {
                        $this->dataFluxContainer()->session()->setFlashMessage('L\'administrateur n\'existe pas ou le mot de passe est invalide');
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

