<?php
namespace Aftral\Qcm\Library\FormProcessor\Answer;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\Answer\AnswerForm\AnswerUpdateForm;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;
use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerSearchDatabase;
use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerDatabase;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerUpdateFormProcessor extends FormProcessor
{
    
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AnswerUpdateForm $answerUpdateForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($answerUpdateForm);
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
                    //créer objet recherche réponse
                    $answerSearch = new AnswerSearchDatabase([
                        'id' => $this->entity()->id(),
                        'answerBody' => $this->entity()->answerBody(),
                        'questionId' => $this->entity()->questionId(),
                        'isSolution' => $this->entity()->isSolution()
                    ]);
                    
                    //on cherche si la reponse est deja présente
                    $responseInBase = $this->managers()->getManagerOf('Answer')->searchIfExists($answerSearch);
                    
                    if (empty($responseInBase))
                    {
                        //on créee l'objet réponse a sauvegarder
                        $newAnswerDatabase = new AnswerDatabase([
                            'id' => $this->entity()->id(),
                            'answerBody' => $this->entity()->answerBody(),
                            'questionId' => $this->entity()->questionId(),
                            'isSolution' => $this->entity()->isSolution()
                        ]);
                        
                        //si la réponse n'existe pas on sauvegarde
                        $this->managers()->getManagerOf('Answer')->save($newAnswerDatabase);
                        
                        $this->dataFluxContainer()->response()->redirect('/admins/answer/list');
                    }
                    else
                    {
                        $this->dataFluxContainer()->session()->setFlashMessage('Cette réponse existe déjà');
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

