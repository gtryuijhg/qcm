<?php
namespace Aftral\Qcm\Library\QcmBuilder;

use Aftral\Qcm\Library\Core\HTTPRequest;
use Aftral\Qcm\Library\Core\Managers;
use Aftral\Qcm\Library\Entities\Qcm\Qcm;
use Aftral\Qcm\Library\Entities\Question\Question;
use Aftral\Qcm\Library\Entities\Answer\Answer;
/**
 * 
 * @author gregoire.huteau
 *
 */
class QcmBuilder
{
    private $_request;
    private $_managers;
    private $_questionList = [];
    private $_answerList = [];
    private $_solutionList = [];
    private $_qcm;
    
    public function __construct($request, $managers)
    {
        $this->setRequest($request);
        $this->setManagers($managers);
    }
    
    public function build()
    {
        // on créée un objet qcm vide
        $this->_qcm = new Qcm([]);
        
        //on recupere les questions correspondant au type de question de la requete
        $questionList = $this->_managers->getManagerOf('Question')->getQuestionListByType($this->_request->getData('questionType'));
        
        //on melange les questions et on en garde 10
        shuffle($questionList);
        
        $questionNumber = 0;
        
        while ($questionNumber < 10)
        {
            foreach ($questionList as $question)
            {
                $this->_questionList[] = $question;
                $questionNumber++;
            }
        }
        
        //pour chaque question on recupere les réponses et les solutions en fonction des id des questions
        foreach ($this->_questionList as $question)
        {
            $question = new Question($question);
            
            $answerNumber = 0;
            
            //on recupere la liste des solutions
            $solutionList = $this->_managers->getManagerOf('Answer')->getQcmSolutionsByQuestionId($question->id(), 'oui');
            
            //pour chaque solution on compte 1 réponse et on la met dans l'array solutions;
            foreach ($solutionList as $solution)
            {
                $solution = new Answer($solution);
                
                $this->_solutionList[] = $solution;
                
                $answerNumber++;
            }
            
            //on met les solutions dans l'array solutions qcm
            $this->_qcm->setSolutions($this->_solutionList);
            
            //on recupere la liste des réponses
            $answerList = $this->_managers->getManagerOf('Answer')->getQcmAnswersByQuestionId($question->id(), 'non');
            
            //on melange (pour ordre aleatoire)
            shuffle($this->_answerList);
            
            //on compte jusqu'à 4 réponses en partant du compte solutions et on met les réponses dans l'array réponse
            while($answerNumber < 4)
            {
                foreach ($answerList as $answer)
                {
                    $answer = new Answer($answer);
                    
                    $this->_answerList[] = $answer;
                }
            }
            
            //on met les réponses dans l'array réponses du qcm
            $this->_qcm->setAnswers($this->_answerList);            
        }
        
        //on met les questions dans l'array questions du qcm
        $this->_qcm->setQuestions($this->_questionList);
       
        //on retourne l'objet qcm
        return $this->_qcm;
    }
    
    /**
     * 
     * @param HTTPRequest $request
     */
    public function setRequest(HTTPRequest $request):void
    { 
        $this->_request = $request;
    }
    
    /**
     * 
     * @param Managers $managers
     */
    public function setManagers(Managers $managers):void
    {
        $this->_managers = $managers;
    }
}

