<?php
namespace Aftral\Qcm\Library\FormProcessor\Question;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerDatabase;
use Aftral\Qcm\Library\Entities\Question\QuestionDatabase\QuestionDatabase;
use Aftral\Qcm\Library\Entities\Question\QuestionDatabase\QuestionSearchDatabase;
use Aftral\Qcm\Library\Entities\Question\QuestionForm\QuestionUpdateForm;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionUpdateFormProcessor extends FormProcessor
{
   
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param QuestionUpdateForm $questionUpdateForm
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, QuestionUpdateForm $questionUpdateForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($questionUpdateForm);
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
                    //on créée l'objet de recherches
                    $questionSearch = new QuestionSearchDatabase([
                        'questionBody' => $this->entity()->questionBody(),
                        'questionType' => $this->entity()->questionType(),
                        'solutionsNumber' => $this->entity()->solutionsNumber()
                    ]);
                    
                    //on cherche si la question est déja présente
                    $questionInBase = $this->managers()->getManagerOf('Question')->searchQuestion($questionSearch);
                    
                    if (empty($questionInBase))
                    {
                        //on supprime les réponses de la question à modifier (question différente donc réponses à redéfinir)
                        $listAnswers = $this->managers()->getManagerOf('Answer')->searchAllLinkedAnswers($this->entity()->id());
                        
                        foreach ($listAnswers as $answer)
                        {
                            $answer = new AnswerDatabase($answer);
                            
                            $this->managers()->getManagerOf('Answer')->delete($answer->id());
                        }
                        
                        
                        //on créee un objet question modifié
                        $newQuestion = new QuestionDatabase([
                            'id' => $this->entity()->id(),
                            'questionBody' => $this->entity()->questionBody(),
                            'questionType' => $this->entity()->questionType(),
                            'solutionsNumber' => $this->entity()->solutionsNumber()
                        ]);
                        
                        //on sauvegarde la question modifiée
                        $this->managers()->getManagerOf('Question')->save($newQuestion);
                        
                        //on redirige l'administrateur
                        $this->dataFluxContainer()->response()->redirect('/admins/question/list');
                    }
                    else
                    {
                        $this->dataFluxContainer()->session()->setFlashMessage('Cette question existe déjà');
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

