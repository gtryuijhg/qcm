<?php
namespace Aftral\Qcm\Library\FormProcessor\Question;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerDatabase;
use Aftral\Qcm\Library\Entities\Question\QuestionForm\QuestionDeleteForm;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionDeleteFormProcessor extends FormProcessor
{    
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param QuestionDeleteForm $question
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, QuestionDeleteForm $questionDeleteForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($questionDeleteForm);
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
                    //on recupere le mot de passe administrateur par son id
                    $sessionAppAdmin = $this->dataFluxContainer()->session()->getAttribute('sessionAppAdmin');
                    
                    $adminInBase = $this->managers()->getManagerOf('AppAdmin')->searchById($sessionAppAdmin->id());
                    
                    //on verifie le mot de passe
                    if (password_verify($this->entity()->appAdminPassword(), $adminInBase->appAdminPassword()))
                    {                       
                        //on verifie si des réponses sont liées à la question
                        $listAnswers = $this->managers()->getManagerOf('Answer')->searchAllLinkedAnswers($this->entity()->id());
                        
                        if ($listAnswers != NULL)
                        {
                            foreach ($listAnswers as $answer)
                            {
                                $answer = new AnswerDatabase($answer);
                                
                                //on supprime les réponses
                                $this->managers()->getManagerOf('Answer')->delete($answer->id());
                            }
                        }
                        
                        //on supprime la question
                        $this->managers()->getManagerOf('Question')->delete($this->entity()->id());
                        
                        //on redirige l'administrateur sur les questions
                        $this->dataFluxContainer()->response()->redirect('/admins/question/list');
                    }
                    else
                    {
                        $this->dataFluxContainer()->session()->setFlashMessage('Veuilez saisir votre mot de passe');
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

