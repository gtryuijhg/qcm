<?php
namespace Aftral\Qcm\Library\FormBuilder\Qcm;

use Aftral\Qcm\Library\FormBuilder\FormBuilder;
use Aftral\Qcm\Library\Entities\Answer\Answer;
use Aftral\Qcm\Library\Form\CheckBoxField;
use Aftral\Qcm\Library\Form\QcmQuestionField;
use Aftral\Qcm\Library\Entities\Question\Question;

/**
 * 
 * @author gregoire.huteau
 *
 */
class QcmFormBuilder extends FormBuilder
{
    private $_qcmForm;
    private $_question = [];
    private $_listAnswers = [];
    
    public function __construct($entity)
    {
        if (!empty($entity))
        {
            parent::__construct($entity);
            
            $this->_qcmForm = $entity;
        }       
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Aftral\Qcm\Library\FormBuilder\FormBuilder::build()
     */
    public function build()
    {   
        $listQuestions = $this->_qcmForm->questions();
        
        shuffle($listQuestions);
        
        foreach ($listQuestions as $question)
        {    
            $this->_question = NULL;
            $this->_listAnswers = [];
            
            $question = new Question([
                'id' => $question->id(),
                'questionBody' => $question->questionBody(),
                'questionType' => $question->questionType(),
                'solutionsNumber' => $question->solutionsNumber()
                
            ]);
            
            $answerNumber = 0;
            
            //on met les solutions dans l'objet question qcm
            foreach ($this->_qcmForm->solutions() as $solution)
            {
                while ($answerNumber < 4)
                {
                    $solution = new Answer([
                        'id' => $solution->id(),
                        'answerBody' => $solution->answerBody(),
                        'questionId' => $solution->questionId(),
                        'isSolution' => $solution->isSolution()
                    ]);
                    
                    if ($solution->questionId() == $question->id())
                    {
                        $solutionField = new CheckBoxField([
                            'label' => $solution->answerBody(),
                            'name' => 'solution'
                        ]);
                        
                        $this->_listAnswers[] = $solutionField;
                    }
                }
            }
            
            //on met des réponses non solutions dans l'objet qcm (total réponses + solutions = 4)
            foreach ($this->_qcmForm->answers() as $answer)
            {
                while ($answerNumber < 4)
                {
                    $answer = new Answer([
                        'id' => $solution->id(),
                        'answerBody' => $solution->answerBody(),
                        'questionId' => $solution->questionId(),
                        'isSolution' => $solution->isSolution()
                    ]);
                    
                    if ($answer->questionId() == $question->id())
                    {
                        $answerField = new CheckBoxField([
                            'label' => $answer->answerBody(),
                            'name' => 'answer'
                        ]);
                        
                        $this->_listAnswers[] = $answerField;
                    }
                }
                
            }
            
            //on melange les réponses (pour avoir un qcm a ordre aléatoire comme avec les questions)
            shuffle($this->_listAnswers);
            
            $this->_question = new QcmQuestionField([
                'name' => 'question',
                'qcmQuestionBody' => $question->questionBody(),
                'qcmQuestionAnswers' => $this->_listAnswers
            ]);
            
            $this->form()->add($this->_question);
                
        }               
    }
}

