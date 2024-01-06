<?php
namespace Aftral\Qcm\Library\FormProcessor\AppAdmin;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\AppAdmin;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminForm\AppAdminRegisterForm;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminDatabase\AppAdminByNameSearchDatabase;
use Aftral\Qcm\Library\Entities\AppAdmin\AppAdminDatabase\AppAdminDatabase;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AppAdminRegisterFormProcessor extends FormProcessor
{
    
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param AppAdmin $appAdmin
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AppAdminRegisterForm $appAdminRegisterForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($appAdminRegisterForm);
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
                    //on cherche si le mot de passe et la confirmation correspondent
                    if ($this->entity()->appAdminPassword() == $this->entity()->confirmAppAdminPassword())
                    {
                        //on crée un objet pour la recherche en base
                        $appAdminByNameSearch = new AppAdminByNameSearchDatabase([
                            'appAdminFirstName' => $this->entity()->appAdminFirstName(),
                            'appAdminLastName' => $this->entity()->appAdminLastName()
                        ]);
                        
                        //on cherche un administrateur en fonction de son nom et prénom
                        $appAdminInBase = $this->managers()->getManagerOf('AppAdmin')->searchByFirstNameAndLastName($appAdminByNameSearch);
                        
                        //si on a aucun administrateur trouvé en base
                        if (empty($appAdminInBase))
                        {
                            $appAdminDatabase = new AppAdminDatabase([
                                'appAdminFirstName' => $this->entity()->appAdminFirstName(),
                                'appAdminLastName' => $this->entity()->appAdminLastName(),
                                'appAdminLogin' => $this->entity()->appAdminLogin(),
                                'appAdminPassword' => password_hash($this->entity()->appAdminPassword(), PASSWORD_DEFAULT)
                            ]);
                            
                            //on sauvegarde l'administrateur
                            $this->managers()->getManagerOf('AppAdmin')->save($appAdminDatabase);
                            
                            $this->dataFluxContainer()->response()->redirect('/admins/admin/signin');
                        }
                        else
                        {
                            $this->dataFluxContainer()->session()->setFlashMessage('Cet administrateur existe déjà');
                        }
                    }
                    else
                    {
                        $this->dataFluxContainer()->session()->setFlashMessage('Le mot de passe et sa confirmation sont différents');
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

