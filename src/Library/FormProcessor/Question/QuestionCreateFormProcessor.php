<?php
namespace Aftral\Qcm\Library\FormProcessor\Question;

use Aftral\Qcm\Library\Core\DataFluxContainer;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\Question\QuestionDatabase\QuestionSearchDatabase;
use Aftral\Qcm\Library\Entities\Question\QuestionForm\QuestionCreateForm;
use Aftral\Qcm\Library\Form\Form;
use Aftral\Qcm\Library\FormProcessor\FormProcessor;
use Aftral\Qcm\Library\Entities\Question\QuestionDatabase\QuestionDatabase;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QuestionCreateFormProcessor extends FormProcessor
{
    /**
     * 
     * @param Form $form
     * @param Managers $managers
     * @param DataFluxContainer $dataFluxContainer
     * @param QuestionCreateForm $questionCreateForm
     */
    public function __construct(Form $form, Managers $managers, DataFluxContainer $dataFluxContainer, QuestionCreateForm $questionCreateForm)
    {
        parent::__construct($form, $managers, $dataFluxContainer);
        
        $this->setEntity($questionCreateForm);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormProcessor\FormProcessor::process()
     */
    public function process()
    {
        //si le formulaire est envoyé
        if ($this->dataFluxContainer()->request()->method() == 'POST')
        {
            //on verifie que les token correspondent et que la requete provient du formulaire
            if ($this->dataFluxContainer()->tokenMatch() && $this->dataFluxContainer()->sourceRequest())
            {
                //si le formulaire est valide
                if ($this->form()->isValid())
                {
                    //on créée un objet de recherches en base
                    $questionSearch = new QuestionSearchDatabase([
                        'questionBody' => $this->entity()->questionBody(),
                        'questionType' => $this->entity()->questionType(),
                        'solutionsNumber' => $this->entity()->solutionsNumber()
                    ]);
                    
                    //on cherche si la question est déja en base
                    $questionInBase = $this->managers()->getManagerOf('Question')->searchQuestion($questionSearch);
                    
                    if (empty($questionInBase))
                    {
                        //on enregistre la question
                        $questionDatabase = new QuestionDatabase([
                            'questionBody' => $this->entity()->questionBody(),
                            'questionType' => $this->entity()->questionType(),
                            'solutionsNumber' => $this->entity()->solutionsNumber()
                        ]);
                        
                        $this->managers()->getManagerOf('Question')->save($questionDatabase);
                        
                        $this->dataFluxContainer()->response()->redirect('/admins/admin/home');
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

