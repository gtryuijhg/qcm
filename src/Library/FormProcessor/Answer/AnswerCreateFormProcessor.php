<?php
namespace Aftral\Qcm\Library\FormProcessor\Answer;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\Answer\Answer;
use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerDatabase;
use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerSearchDatabase;
use Aftral\Qcm\Library\Entities\Answer\AnswerForm\AnswerCreateForm;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerCreateFormProcessor extends FormProcessor
{
    
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param Answer $answer
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AnswerCreateForm $answerCreateForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($answerCreateForm);
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
                    //creer objet recherche base de données
                    $answerSearch = new AnswerSearchDatabase([
                        'answerBody' => $this->entity()->answerBody(),
                        'questionId' => $this->entity()->questionId(),
                        'isSolution' => $this->entity()->isSolution()
                    ]);
                    
                    //on cherche si la reponse est deja présente (utiliser objet recherche base de données)
                    $answerInBase = $this->managers()->getManagerOf('Answer')->searchIfExists($answerSearch);
                    
                    if (empty($answerInBase))
                    {   
                        //créer objet reponse a sauvegarder
                        $answerDatabase = new AnswerDatabase([
                            'answerBody' => $this->entity()->answerBody(),
                            'questionId' => $this->entity()->questionId(),
                            'isSolution' => $this->entity()->isSolution()
                        ]);
                        
                        //si la réponse n'est pas une solutioni de la question
                        if ($answerDatabase->isSolution() == 'non')
                        {                       
                            //on sauvegarde la réponse
                            $this->managers()->getManagerOf('Answer')->save($answerDatabase);
                            
                            $this->dataFluxContainer()->response()->redirect('/admins/admin/home');
                        }
                        
                        //si la réponse est une solution, on cherche si le nombre de solutions est déjà égal au nombre defini par la question
                        else
                        {
                            //on cherche la question correspondante
                            $questionInBase = $this->managers()->getManagerOf('Question')->searchQuestionById($answerDatabase->questionId());
                            
                            $solutionsNumber = $this->managers()->getManagerOf('Answer')->getSolutions($answerDatabase->questionId(), $answerDatabase->isSolution());
                            
                            //si le nombre de réponses solutions est strictement inférieur au nombre maximum de solutions de la question
                            if ($solutionsNumber < $questionInBase->solutionsNumber())
                            {
                                //on sauvegarde la réponse
                                $this->managers()->getManagerOf('Answer')->save($answerDatabase);
                                
                                $this->dataFluxContainer()->response()->redirect('/admins/admin/home');
                            }
                            else
                            {
                                $this->dataFluxContainer()->session()->setFlashMessage('Nombre maximum de solutions atteint');
                            }
                        }
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

