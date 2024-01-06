<?php
namespace Aftral\Qcm\Library\FormProcessor\AppAdmin;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminDatabase\AppAdminDatabase;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminForm\AppAdminUpdateForm;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminUpdateFormProcessor extends FormProcessor
{   
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param AppAdminUpdateForm $appAdminUpdateForm
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AppAdminUpdateForm $appAdminUpdateForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($appAdminUpdateForm);
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
                  
                    //on recupere l'administrateur en base par son id en session
                    $adminInBase = $this->managers()->getManagerOf('AppAdmin')->searchById($sessionAppAdmin->id());
                    
                    //on verifie la concordance dees mots de passe
                    if (password_verify($this->entity()->appAdminPassword(), $adminInBase->appAdminPassword()))
                    {
                        
                        //on vérifie si les deux nouveaux mots de passe sont identiques
                        if ($this->entity()->newAppAdminPassword() == $this->entity()->confirmNewAppAdminPassword())
                        {
                            //on crée un objet administrateur pour modification (avec id)
                            $modifiedAppAdmin = new AppAdminDatabase([
                                'id' => $adminInBase->id(),
                                'appAdminFirstName' => $adminInBase->appAdminFirstName(),
                                'appAdminLastName' => $adminInBase->appAdminLastName(),
                                'appAdminLogin' => $adminInBase->appAdminLogin(),
                                'appAdminPassword' => password_hash($this->entity()->newAppAdminPassword(), PASSWORD_DEFAULT)
                            ]);
                            
                            //on sauvegarde l'administrateur modifié
                            $this->managers()->getManagerOf('AppAdmin')->save($modifiedAppAdmin);
                            
                            $this->dataFluxContainer()->response()->redirect('/admins/admin/home');
                        }
                        else
                        {
                            $this->dataFluxContainer()->session()->setFlashMessage('Le nouveau mot de passe et la confirmation sont différents');
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

