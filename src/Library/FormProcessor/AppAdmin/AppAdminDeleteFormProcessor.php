<?php
namespace Aftral\Qcm\Library\FormProcessor\AppAdmin;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\AppAdmin;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminForm\AppAdminDeleteForm;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminDeleteFormProcessor extends FormProcessor
{
    
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param AppAdmin $appAdmin
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AppAdminDeleteForm $appAdminDeleteForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($appAdminDeleteForm);
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
                    $sessionAppAdmin = $this->dataFluxContainer()->session()->getAttribute('sessionAppAdmin');
                    
                    //on recupere le mot de passe de l'administrateur en session
                    $adminInBase = $this->managers()->getManagerOf('AppAdmin')->searchById($sessionAppAdmin->id());
                    
                    //on verifie la concordance des mots de passe
                    if (password_verify($this->entity()->appAdminPassword(), $adminInBase->appAdminPassword()))
                    {         
                        //on supprime l'administrateur
                        $this->managers()->getManagerOf('AppAdmin')->delete($sessionAppAdmin->id());
                        
                        //on déconnecte l'administrateur supprimé
                        $this->dataFluxContainer()->response()->redirect('/admins/admin/disconnect');
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

