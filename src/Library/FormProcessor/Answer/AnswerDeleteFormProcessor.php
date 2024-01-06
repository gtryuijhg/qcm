<?php
namespace Aftral\Qcm\Library\FormProcessor\Answer;

use Aftral\Qcm\Library\Entities\Answer\AnswerDatabase\AnswerDatabase;
use Aftral\Qcm\Library\Entities\Answer\AnswerForm\AnswerDeleteForm;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;
use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;

/**
 * 
 * @author gregoire.huteau
 *
 */
class AnswerDeleteFormProcessor extends FormProcessor
{
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, AnswerDeleteForm $answerDeleteForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($answerDeleteForm);
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
                        //on cherche les informations de la réponse en base
                        $answerInBase = $this->managers()->getManagerOf('Answer')->searchAnswerById($this->entity()->id());
                        
                        //si la réponse est une solution de la question correspondante
                        if ($answerInBase->isSolution() == 'oui')
                        {
                            //on liste toutes les réponses liées a la question et on les supprime
                            $listAnswers = $this->managers()->getManagerOf('Answer')->searchAllLinkedAnswers($answerInBase->questionId());
                            
                            foreach ($listAnswers as $answer)
                            {
                                $answer = new AnswerDatabase($answer);
                                
                                $this->managers()->getManagerOf('Answer')->delete($answer->id());
                            }
                            
                            //on supprime la question
                            $this->managers()->getManagerOf('Question')->delete($answerInBase->questionId());
                        }
                        //sinon on supprime juste la réponse (qui n'est pas solution de la question)
                        else
                        {
                            $this->managers()->getManagerOf('Answer')->delete($answerInBase->id());
                        }
                        
                        //on redirige l'administrateur sur les réponses
                        $this->dataFluxContainer()->response()->redirect('/admins/answer/list');
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

